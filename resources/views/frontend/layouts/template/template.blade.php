<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"/>
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>PHANGNGA MARATHON</title>
		<meta name="author" content="codepixer">
		<meta name="description" content="">
		<meta name="keywords" content="">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
        </style>
		@include("/frontend/layouts/css/css")
	</head>
	<body>

        <!-- Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="assets/img/logo/loder.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Preloader Start -->
        @include("frontend/layouts/navbar/navbar")
        <main>
            @yield("content")
        </main>
        @include("frontend/layouts/footer/footer")
		@include("frontend/layouts/js/js")
	</body>
</html>