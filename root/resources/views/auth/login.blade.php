<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }} | {{ trans('lang.login') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('assets/global/css/components-rounded.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a><img src="{{asset('assets/upload/temps/app_logo.png')}}" style="height: 100px;" alt="{{ config('app.name') }}" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="frmLogin" role="form" method="POST" action="{{ url('/login') }}">
				{{ csrf_field() }}
				<div class="form-title">
                    <span class="form-title">{{ trans('lang.welcome') }}</span>
                    <span class="form-subtitle">{{ trans('lang.please_login') }}</span>
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
					<span></span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">{{ trans('lang.email') }}</label>
					<input id="email" type="email" placeholder="{{ trans('lang.email') }}" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">{{ trans('lang.password') }}</label>
                    <input id="password" type="password" placeholder="{{ trans('lang.password') }}" class="form-control" name="password" required>

					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
                <div class="form-actions">
                    <button type="submit" id="btnLogin" name="btnLogin" class="btn red btn-block uppercase">{{ trans('lang.login') }}</button>
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright">  <?= date('Y') ?> &copy; {{ trans('lang.purchase_system') }} </div>
        <!-- END LOGIN -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
    </body>
</html>
