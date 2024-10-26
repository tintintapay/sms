<div class="left-panel">
    <a href="home" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'dashboard' ? 'active' : ''?>">
            <span class="menu-title">Dashboard</span>
        </div>
    </a>
    <a href="coordinators" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'coordinators' ? 'active' : '' ?>">
            <span class="menu-title">Coordinator</span>
        </div>
    </a>
    <a href="manage-athlete" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'manage_athlete' ? 'active' : '' ?>">
            <span class="menu-title">Manage Athlete</span>
        </div>
    </a>
    <a href="allowance" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'allowance' ? 'active' : '' ?>">
            <span class="menu-title">Allowance</span>
        </div>
    </a>
    
</div>