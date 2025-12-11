<section class="newsletter_section pt-5">
    <div class="container">
        <div class="newsletter_box">
            <div class="section_title" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                <h2>{{ __('web.newsletter.title') }}</h2>
                <p>{{ __('web.newsletter.subtitle') }}</p>
            </div>

            <form method="POST" action="{{ route('newsletter.subscribe') }}" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                @csrf
                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="{{ __('web.newsletter.email_placeholder') }}"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                    <small class="invalid-feedback d-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn" type="submit">{{ __('web.newsletter.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
