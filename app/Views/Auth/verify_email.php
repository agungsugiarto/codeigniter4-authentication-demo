<?= $this->extend('Auth\Layout\index') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="/">
            <img src="https://codeigniter.com/assets/images/codeigniter4logo.png" class="logo" alt="CodeIgniter Logo" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100%; border: none; height: 85px; width: 85px;">
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Validation Errors and Message -->
        <div class="mb-4 text-sm text-gray-600">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on
            the link we just emailed to you? If you didn&#039;t receive the email, we will gladly send you
            another.
        </div>

        <?= $this->include('Auth\Layout\errors') ?>

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="<?= route_to('verification.send') ?>">
                <?= csrf_field() ?>
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Resend Verification Email
                    </button>
                </div>
            </form>

            <form method="POST" action="<?= route_to('logout') ?>">
                <?= csrf_field() ?>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>