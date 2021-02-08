<?php if (session()->has('message')) : ?>
    <div class="mb-4">
        <div class="font-medium text-sm text-green-600">
            <?= session('message') ?>
        </div>
    </div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
    <div class="mb-4">
        <div class="font-medium text-red-600">
            Whoops! Something went wrong.
        </div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li><?= session('error') ?></li>
        </ul>
    </div>
<?php endif ?>

<?php if (session()->has('errors')) : ?>
    <div class="mb-4">
        <div class="font-medium text-red-600">
            Whoops! Something went wrong.
        </div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <?php foreach (session('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
