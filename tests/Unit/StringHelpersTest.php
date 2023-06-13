<?php

use Tests\TestCase;

it('counts the number of vowels in a string', function () {
    // Arrange
    $string = 'John Doe';
    $command = new App\Commands\Calculate();

    // Act
    $result = $command->count_Vowels($string);

    // Assert
    expect($result)->toBe(3);
});

it('counts the number of consonants in a string', function () {
    // Arrange
    $string = 'Jhon Doe';
    $command = new App\Commands\Calculate();

    // Act
    $result = $command->count_consonants($string);

    // Assert
    expect($result)->toBe(4);
});
