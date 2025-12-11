<div id="sessionExpiredOverlay" class="modal-overlay modal-overlay-session" style="display: none;">
    <div id="sessionExpiredModal" class="modal-content modal-content-session">
        <div class="modal-header">
            <h5 class="modal-title">Vypršanie prihlásenia</h5>
        </div>
        <div class="modal-body">
            <p>Boli ste odhlásení z dôvodu nečinnosti. Pre pokračovanie sa prosím prihláste znova.</p>
            <a href="{{route('login')}}" class="btn btn-primary btn-block">Prihlásiť sa</a>
        </div>
    </div>
</div>

<style>
    .modal-overlay-session {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 1050;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content-session {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        width: 400px;
        max-width: 95%;
    }
</style>
