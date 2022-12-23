<div class="col-xl-3 col-md-4">
    <aside class="axil-dashboard-aside">
        <nav class="axil-dashboard-nav">
            <div class="nav">
                <a class="nav-item nav-link <?php echo $profile_tab === 'profile' ? 'active':''; ?>" href="/profile">
                    <i class="fas fa-user"></i>profil
                </a>
                <a class="nav-item nav-link <?php echo $profile_tab === 'favorites' ? 'active':''; ?>"
                   href="/profile/favoris">
                    <i class="fas fa-heart"></i>Favoris
                </a>
                <a class="nav-item nav-link <?php echo $profile_tab === 'alerts' ? 'active':''; ?>" href="/profile/alertes">
                    <i class="fas fa-engine-warning"></i>Alertes
                </a>
                <a class="nav-item nav-link" href="<?php echo wp_logout_url(); ?>">
                    <i class="fal fa-sign-out"></i>Déconnexion
                </a>
            </div>
        </nav>
    </aside>
</div>