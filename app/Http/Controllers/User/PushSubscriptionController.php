<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PushSubscriptionController extends Controller
{
    // Simpan data subscription browser user ke database
    public function subscribe(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|string',
            'keys.p256dh' => 'required|string',
            'keys.auth'   => 'required|string',
        ]);

        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->input('keys.p256dh'),
            $request->input('keys.auth'),
            $request->contentEncoding ?? null
        );

        return response()->json(['status' => 'subscribed']);
    }

    // Hapus subscription (misal saat user matiin notifikasi)
    public function unsubscribe(Request $request)
    {
        $request->validate(['endpoint' => 'required|string']);
        $request->user()->updatePushSubscription($request->endpoint);

        return response()->json(['status' => 'unsubscribed']);
    }

    // Generate JS client secara dinamis, sudah termasuk VAPID public key
    public function clientScript()
    {
        $vapidPublicKey = config('webpush.vapid.public_key');
        $subscribeUrl   = route('webpush.subscribe');
        $csrfToken      = csrf_token();

        $js = <<<JS
(function () {
    if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
        return; // Browser tidak mendukung web push
    }

    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        return Uint8Array.from([...rawData].map((c) => c.charCodeAt(0)));
    }

    navigator.serviceWorker.register('/sw.js').then(function (registration) {
        if (Notification.permission === 'denied') return;

        Notification.requestPermission().then(function (permission) {
            if (permission !== 'granted') return;

            registration.pushManager.getSubscription().then(function (existing) {
                if (existing) return; // Sudah subscribe sebelumnya

                registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array('{$vapidPublicKey}')
                }).then(function (subscription) {
                    fetch('{$subscribeUrl}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{$csrfToken}'
                        },
                        body: JSON.stringify(subscription)
                    });
                }).catch(function (err) {
                    console.log('Gagal subscribe push notification:', err);
                });
            });
        });
    });
})();
JS;

        return response($js, 200)->header('Content-Type', 'application/javascript');
    }
}
