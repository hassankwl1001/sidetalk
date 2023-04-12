<section class="chatbox js-chatbox my-5">
    <div class="chatbox__header">
      <h3 class="chatbox__header-cta-text">
          <span class="chatbox__header-cta-icon">
              <figure class="image-container">
                  <img class="img-size" src="{{ $profile_pic }}" alt="">
              </figure>
          </span>
      Chat Box</h3>
      <button class="js-chatbox-toggle chatbox__header-cta-btn u-btn">
{{--          <span>--}}
{{--              <i class="fas fa-circle"></i>--}}
{{--              <i class="fas fa-circle"></i>--}}
{{--              <i class="fas fa-circle"></i>--}}
{{--          </span>--}}
{{--          <i class="far fa-edit"></i>--}}
          <i class="fas fa-chevron-up"></i>
      </button>
    </div>
    <div class="js-chatbox-display chatbox__display">
{{--        <div class="message">--}}
{{--            <p>How are you ?</p>--}}
{{--        </div>--}}
{{--        <div class="message message-right">--}}
{{--            <p>i'm fine how are you?</p>--}}
{{--        </div>--}}
        @livewire('conversation-list')
    </div>
{{--    <form class="js-chatbox-form chatbox__form">--}}
{{--      <input type="text" class="js-chatbox-input chatbox__form-input" placeholder="Type your message..." required>--}}
{{--      <button class="chatbox__form-submit u-btn"><i class="far fa-paper-plane"></i></button>--}}
{{--    </form>--}}
  </section>
