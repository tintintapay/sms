<div class="header">
    <div class="profile">
        <div class="profile-pic">
            <img src="<?= "../assets/uploads/docs/{$_SESSION['user_id']}/{$_SESSION['picture']}" ?>"
                alt="User Icon" class="profile-pic" onError="this.src='../assets/images/empty.png'">
        </div>
        <div class="profile-info">
            <h2><?php echo $_SESSION['full_name'] ?></h2>
            <p><?php echo $_SESSION['role']; ?></p>
        </div>
    </div>
    <a href="../logout" class="sms-btn btn-white">Logout</a>
</div>