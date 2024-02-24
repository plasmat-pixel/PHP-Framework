<?php

return new class
{

    public function up(): void
    {
        echo get_class() . 'method up' . PHP_EOL;
    }

    public function down(): void
    {
        echo get_class() . 'method down' . PHP_EOL;
    }
};
