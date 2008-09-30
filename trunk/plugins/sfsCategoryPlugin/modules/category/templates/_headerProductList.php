<?php if ($category !== null): ?>
    <div class="container_header">
        <div class="corner_left">
            <div class="corner_right">
                <div class="content"><?php echo $category->getTitle() ?></div>
            </div>
        </div>
    </div>
<?php endif; ?>