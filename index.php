<?php get_header(); ?>

<article class="flex vh-100">
    <div class="w-40-l pa4 vh-100 flex flex-column justify-center-l">
        <h1 class="fw4 measure ma0 mt4 serif f3 f2-ns">
            <span class="ttu tracked f7 fw3 gray lh-copy db mb2 sans-serif">Andelsboligforeningen</span>
            Høegh-Guldbergs Gade 71-71A
        </h1>
        <section class="measure lh-copy mt3 f6 f5-ns">
            <?php the_post();
            the_content(); ?>
        </section>

        <section class="mt3 f6">
            <?php if (is_user_logged_in()) : ?>
                <p class="lh-copy">
                    <?php $user = wp_get_current_user(); ?>
                    Gå til:
                    <a href="#documents" class="link pa1 ph2 f7 navy bg-lightest-blue br2 dim dib">
                        Dokumenter og referater
                    </a>
                </p>
                <p class="lh-copy">
                    Bestyrelse:
                    <?php if (current_user_can('publish_posts')) : ?>
                        <a href="<?php bloginfo('url') ?>/wp-admin/edit.php?post_type=sdm_downloads" class="link pa1 ph2 f7 navy bg-lightest-blue br2 dim dib mv1">
                            Administrer filer
                        </a>
                        <a href="<?php bloginfo('url') ?>/wp-admin/post-new.php?post_type=sdm_downloads" class="link pa1 ph2 f7 navy bg-lightest-blue br2 dim dib mv1">
                            Tilføj ny fil
                        </a>
                        <a href="<?php bloginfo('url') ?>/wp-admin/user-new.php" class="link pa1 ph2 f7 navy bg-lightest-blue br2 dim dib mv1">
                            Opret bruger
                        </a>
                    <?php endif; ?>
                </p>
            <?php else : ?>
                <a href="#login" class="link pa1 ph2 f7 navy bg-lightest-blue br2 dim dib">
                    Log ind
                </a>
                for at se dokumenter og referater
            <?php endif; ?>
        </section>
    </div>
    <div class="w-60 vh-100 ba bw5 b--white dn db-l" style="background-position: center;background-image: url('<?php echo get_template_directory_uri() . '/hgg71-71a.jpg' ?>'); background-size: cover">

    </div>
</article>

<?php if (is_user_logged_in()) : ?>
    <article class="vh-100-ns bg-near-white" id="documents">
        <nav class="w-100 pa5-l pv3-l pa3 pv3 f6 gray flex items-center">
            <?php echo $user->user_email ?>
            <a href="<?php echo wp_logout_url(get_bloginfo('url')) ?>" class="ml2 link dib f7 bg-moon-gray black-80 pa1 ph2 br2 dim">Log ud</a>
        </nav>
        <div class="w-50-l fl-l pa5-l pa3 pt0 pt0-l">
            <h2 class="ma0">Dokumenter</h2>
            <p class="measure lh-copy">
                Her finder du foreningens generelle dokumenter.
            </p>
            <?php echo do_shortcode('[sdm_show_dl_from_category category_slug="dokumenter" orderby="date" order="desc"]') ?>
        </div>
        <div class="w-50-l fl-l pa5-l pa3 pt0 pt0-l">
            <h2 class="ma0">Referater</h2>
            <p class="measure lh-copy">
                Her finder du referater fra bestyrelsesmøder og generalforsamling.
            </p>
            <?php echo do_shortcode('[sdm_show_dl_from_category category_slug="referater" orderby="date" order="desc"]') ?>
        </div>
    </article>
<?php else : ?>
    <article class="vh-100 bg-near-white flex-l" id="login">
        <div class="w-50-l vh-100-l flex items-center justify-center bg-white pb4 pa0-l">
            <form action="<?php bloginfo('url') ?>/wp-login.php" method="post" class="measure-narrow w-100 h5-l">
                <h2>
                    Log ind
                </h2>
                <div class="mb3">
                    <label for="login-username" class="db mb1 f6">
                        E-mail
                    </label>
                    <input type="text" class="sans-serif pa2 br2 ba w-100" name="log" id="login-username">
                </div>
                <div class="mb3">
                    <label for="login-password" class="db mb1 f6">Adgangskode</label>
                    <input type="password" class="sans-serif pa2 br2 ba w-100" name="pwd" id="login-password">
                </div>
                <div class="mb3">
                    <label for="login-remember" class="mb1 f6">Forbliv logget ind</label>
                    <input name="rememberme" type="checkbox" id="login-remember" value="forever" />
                </div>
                <div>
                    <input type="hidden" name="redirect_to" value="<?php bloginfo('url') ?>"><br />
                    <input type="submit" value="Log ind" class="bn br2 bg-blue white pa2 ph3 f6 dark-gray">
                    <a href="<?php bloginfo('url') ?>#top" class="link f6 ph2 dim gray">Tilbage</a>
                </div>
            </form>
        </div>
        <div class="w-50-l vh-100-l flex items-center justify-center">
            <div class="measure-l w-100 h5-l measure-narrow">
                <h2 class="gray">Anmod om login</h2>
                <p class="lh-copy f6">
                    Hvis du ønsker et login, skal du sende en anmodning til: <span class="blue">bestyrelse snabel-a hgg71-71a.dk</span>.
                </p>
            </div>
        </div>
    </article>
<?php endif; ?>

<?php get_footer(); ?>