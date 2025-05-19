<style>

.preloader-img img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 50%;
}

</style>

<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img">
                <img class="m-auto" src="{{ asset('storage/' . $siteSetting->preloader_img) }}" alt="">
            </div>
        </div>
    </div> 
</div> 
<!-- Preloader end -->