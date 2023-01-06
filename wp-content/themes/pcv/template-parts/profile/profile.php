<?php
$password_changed = false;

if ( isset( $_POST['change-password-btn'] ) ) {

	$current_password    = $_POST['current_password'];
	$new_password        = $_POST['new_password'];
	$repeat_new_password = $_POST['repeat_new_password'];

	if ( $check_password = wp_check_password( $current_password, $user->user_pass, $user->ID ) ) {

		$password_validate = \App\User::validate_password( $new_password, $repeat_new_password );

		if ( $password_validate['success'] ) {
			wp_set_password( $new_password, $user->ID );
			$password_changed = true;
		}

	};

}
?>

<div class="col-lg-9">
    <div class="axil-dashboard-account">
        <form class="account-details-form" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" value="<?php echo $user->user_email; ?>" disabled>
                    </div>
                    <h5 class="title">Modifier le mot de passe</h5>
					<?php if ( isset( $password_validate )
					           && ! $password_validate['success']
					           && ! $password_changed ) { ?>
                        <div class="alert alert-warning mb--35">
							<?php echo $password_validate['message']; ?>
                        </div>
					<?php } ?>
					<?php if ( $password_changed ) { ?>
                        <div class="alert alert-success mb--35">
                            le mot de passe a été modifié avec succès.
                        </div>
					<?php } ?>
                    <div class="form-group">
                        <label>Mot de passe actuel</label>
                        <input type="password" class="form-control" name="current_password">
                    </div>
                    <div class="form-group">
                        <label>Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>
                    <div class="form-group">
                        <label>Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control" name="repeat_new_password">
                    </div>
                    <div class="form-group mb--0">
                        <button type="submit" class="axil-btn btn-bg-primary submit-btn" name="change-password-btn">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>