@component('site.layouts.content',['title'=>'پرداخت موفقیت آمیز'])
    @slot('headerTitle')
        پرداخت موفقیت آمیز
    @endslot
    <div class="container" id="auth-container" style="margin-top:2rem!important;height: auto;min-height: 260px">
        <div id="phoneNumber">
            <div class="d-flex flex-column w-100 h-100 align-items-center justify-content-center">
                <h style="text-align: center;font-size: 2rem;font-weight: 600;padding-bottom: 20px;color: green" id="login-title">
                      <i class="feather icon-check-circle"></i>
                </h>
                <h3 style="color: green">
                    .پرداخت موفقیت آمیز بود
                </h3>
                <h5>
                    .در صورت انتخاب تحویل حضوری،به انتشارات مراجعه فرمایید
                </h5>
                <p>{{$verify}}</p>
            </div>
        </div>
    </div>
@endcomponent
