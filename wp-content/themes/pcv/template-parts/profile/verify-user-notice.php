<div class="alert alert-warning">
    Veuillez confirmer votre adresse email en cliquant sur le lien que nous vous avons envoyé sur
    <b><?php echo $user->user_email; ?></b> lors de la création de votre compte.
    <br>
    Vous n'avez pas reçu d'email ? <a class="text-decoration-underline"
            href="<?php echo get_permalink( get_field(\App\ACFSetup::OPTION_PAGE_RESEND_VERIFICATION_EMAIL,'option')->ID); ?>">Cliquez ici
        pour en recevoir un nouveau.</a>
</div>