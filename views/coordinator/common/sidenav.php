<div class="left-panel">
    <a href="home" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'dashboard' ? 'active' : ''?>">
            <span class="menu-title">Dashboard</span>
        </div>
    </a>
    <a href="game-schedules" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'game_event' ? 'active' : '' ?>">
            <span class="menu-title">Game Event</span>
        </div>
    </a>
    <a href="athlete-ratings" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'athlete_rating' ? 'active' : '' ?>">
            <span class="menu-title">Athlete Rating</span>
        </div>
    </a>
    <a href="manage-athlete" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'manage_athlete' ? 'active' : '' ?>">
            <span class="menu-title">Manage Athlete</span>
        </div>
    </a>
    <a href="announcements" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'announcement' ? 'active' : '' ?>">
            <span class="menu-title">Announcement</span>
        </div>
    </a>
    <a href="file-resource" class="menu">
        <div class="menu-item <?= $_SESSION['menu'] === 'file_resource' ? 'active' : '' ?>">
            <span class="menu-title">File Resource</span>
        </div>
    </a>
    
</div>