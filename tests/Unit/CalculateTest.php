<?php

use App\Commands\Calculate;
use LaravelZero\Framework\Testing\TestCase;

it('calculates the SS correctly for even-length street address', function () {
    $command = new Calculate();

    $result = $command->CalculateSS('even_streets.test.txt', 'drivers.test.txt');

    // Assert
    expect($result)->toBeArray();

    expect($result[0])->toBeArray();
    expect($result[0])->toHaveKeys(['driver', 'street', 'score']);

    expect($result[0]['street'])->toBe("Even");
    expect($result[0]['driver'])->toBe("John Doe");
    expect($result[0]['score'])->toBe(4.5);
});

it('calculates the SS correctly for odd-length street address', function () {
    $command = new Calculate();

    $result = $command->CalculateSS('odd_streets.test.txt', 'drivers.test.txt');

    // Assert
    expect($result)->toBeArray();

    expect($result[0])->toBeArray();
    expect($result[0])->toHaveKeys(['driver', 'street', 'score']);

    expect($result[0]['street'])->toBe("Odd");
    expect($result[0]['driver'])->toBe("John Doe");
    expect($result[0]['score'])->toBe(4);
});

it('calculates the SS correctly When Street name is Even and the length of the street name & driver are the same', function () {
    $command = new Calculate();

    $result = $command->CalculateSS('even_streets.test.txt', 'drivers_even.test.txt');

    // Assert
    expect($result)->toBeArray();

    expect($result[0])->toBeArray();
    expect($result[0])->toHaveKeys(['driver', 'street', 'score']);
    expect($result[0]['street'])->toBe("Even");
    expect($result[0]['driver'])->toBe("Even");
    expect($result[0]['score'])->toBe(3.0);
});
