<div class="space-y-4">
    @foreach ($verifications as $verification)
        <div class="border p-4 rounded-lg">
            <p><strong>Oleh:</strong> {{ $verification->approved_by }}</p>
            <p><strong>Status:</strong> {{ $verification->verificationStatus->name }}</p>
            <p><strong>Catatan:</strong> {{ $verification->notes ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $verification->created_at->format('d M Y H:i') }}</p>
        </div>
    @endforeach
</div>
