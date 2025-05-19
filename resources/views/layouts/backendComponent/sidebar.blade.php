<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('backend.home.adminDashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('storage/' . $siteSetting->hero_image) }}" alt="Site Logo" style="max-height: 50px;">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner">

        <!-- Sites Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Sites</span></li>

        <li class="menu-item">
            <a href="{{ route('backend.siteAddition.siteAddition') }}" class="menu-link">
                <i class="fas fa-landmark me-2"></i> 
                <div class="" data-i18n="Chat">All Sites</div>
            </a>
        </li>
        
        <li class="menu-item">
            <a href="{{ route('backend.siteAddition.create') }}" class="menu-link">
                <i class="fas fa-plus-circle me-2"></i> 
                <div class="" data-i18n="Chat">Create Site</div>
            </a>
        </li>

        <!-- Location Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Location</span></li>

        <li class="menu-item">
            <a href="{{ route('backend.location.createDistrict') }}" class="menu-link">
                <i class="fas fa-city me-2"></i> 
                <div class="" data-i18n="Chat">District</div>
            </a>
        </li>
        
        <li class="menu-item">
            <a href="{{ route('backend.location.createThana') }}" class="menu-link">
                <i class="fas fa-building me-2"></i> 
                <div class="" data-i18n="Chat">Thana</div>
            </a>
        </li>

        <!-- Image Gallery Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Image Gallery</span></li>

        <li class="menu-item">
            <a href="{{ route('backend.admin.images') }}" class="menu-link">
                <i class="fas fa-image me-2"></i> 
                <div class="" data-i18n="Chat">User Request</div>
            </a>
        </li>

        <!-- Site Settings Section -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Site Settings</span></li>

        <li class="menu-item">
            <a href="{{ route('backend.siteSetting.editSiteSetting') }}" class="menu-link">
                <i class="fas fa-city me-2"></i> 
                <div class="" data-i18n="Chat">Site Setting</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('backend.siteSetting.editAboutUs') }}" class="menu-link">
                <i class="fas fa-city me-2"></i> 
                <div class="" data-i18n="Chat">AboutUs Setting</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('backend.siteSetting.editContact') }}" class="menu-link">
                <i class="fas fa-city me-2"></i> 
                <div class="" data-i18n="Chat">Contact Setting</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('backend.user.messages') }}" class="menu-link">
                <i class="fas fa-city me-2"></i> 
                <div class="" data-i18n="Chat">User Message</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('backend.settings.index') }}" class="menu-link">
                <i class="fas fa-users me-2"></i> 
                <div class="" data-i18n="Chat">User List</div>
            </a>
        </li>

    </ul>
</aside>
