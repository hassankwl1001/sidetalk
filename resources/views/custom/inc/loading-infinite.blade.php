<style>
    /**************************************************************************
        LOADING PAGE
    **************************************************************************/
    #loading-page1{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 2;
    }
    .loading-page1 .loading-section1 {
        position: absolute;
        top: 50%;
        left: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        transform: translate(-50%, -50%);

    }

    .loading-page1 .loading-section1 .dot-loader {
        padding-left: 2px;
        width: 64px;
        height: 64px;

    }

    .loading-page1 .loading-section1 .dot-loader .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 64px;
        height: 64px;
    }

    .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div {
        position: absolute;
        top: 27px;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: #057642;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }

    .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(1) {
        left: 6px;
        animation: lds-ellipsis1 0.6s infinite;
    }

    .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(2) {
        left: 6px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(3) {
        left: 26px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .loading-page1 .loading-section1 .dot-loader .lds-ellipsis div:nth-child(4) {
        left: 45px;
        animation: lds-ellipsis3 0.6s infinite;
    }

    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }

    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(19px, 0);
        }
    }
</style>

<div class="loading-page1" id="loading-page1" style="display: none;">
    <div class="loading-section1">
        <img src="{{asset('assets/img/skilled.png')}}" alt="" />
        <div class="dot-loader" id="dot-loader">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>