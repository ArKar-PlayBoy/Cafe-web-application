<?php

namespace App\Services;

use App\Models\MenuItem;

class RecommendationService
{
    private WeatherService $weatherService;

    private array $drinks = [
        'hot' => [
            ['name' => 'Hot Latte', 'description' => 'Smooth espresso with steamed milk', 'category' => 'Hot Drinks', 'price' => 4.50],
            ['name' => 'Cappuccino', 'description' => 'Espresso with foam and steamed milk', 'category' => 'Hot Drinks', 'price' => 4.00],
            ['name' => 'Espresso', 'description' => 'Rich and bold single shot', 'category' => 'Hot Drinks', 'price' => 3.00],
            ['name' => 'Hot Chocolate', 'description' => 'Creamy chocolate with steamed milk', 'category' => 'Hot Drinks', 'price' => 4.50],
            ['name' => 'Chai Latte', 'description' => 'Spiced tea with steamed milk', 'category' => 'Hot Drinks', 'price' => 4.50],
            ['name' => 'Americano', 'description' => 'Espresso with hot water', 'category' => 'Hot Drinks', 'price' => 3.50],
        ],
        'cold' => [
            ['name' => 'Iced Latte', 'description' => 'Espresso with cold milk over ice', 'category' => 'Cold Drinks', 'price' => 4.50],
            ['name' => 'Cold Brew', 'description' => 'Smooth slow-steeped coffee', 'category' => 'Cold Drinks', 'price' => 4.00],
            ['name' => 'Iced Americano', 'description' => 'Espresso with cold water over ice', 'category' => 'Cold Drinks', 'price' => 3.50],
            ['name' => 'Frappuccino', 'description' => 'Blended coffee with ice and milk', 'category' => 'Cold Drinks', 'price' => 5.00],
            ['name' => 'Iced Tea', 'description' => 'Refreshing black tea over ice', 'category' => 'Cold Drinks', 'price' => 3.00],
        ],
        'specialty' => [
            ['name' => 'Matcha Latte', 'description' => 'Japanese green tea with steamed milk', 'category' => 'Specialty', 'price' => 5.00],
            ['name' => 'Caramel Macchiato', 'description' => 'Vanilla, espresso, and caramel', 'category' => 'Specialty', 'price' => 5.50],
            ['name' => 'Vanilla Latte', 'description' => 'Espresso with vanilla and steamed milk', 'category' => 'Specialty', 'price' => 4.75],
            ['name' => 'Mocha', 'description' => 'Espresso with chocolate and steamed milk', 'category' => 'Specialty', 'price' => 5.00],
        ],
        'evening' => [
            ['name' => 'Decaf Latte', 'description' => 'Smooth decaf espresso with steamed milk', 'category' => 'Hot Drinks', 'price' => 4.50],
            ['name' => 'Decaf Americano', 'description' => 'Decaf espresso with hot water', 'category' => 'Hot Drinks', 'price' => 3.50],
            ['name' => 'Herbal Tea', 'description' => 'Caffeine-free calming blend', 'category' => 'Hot Drinks', 'price' => 3.50],
            ['name' => 'Hot Chocolate', 'description' => 'Creamy chocolate with steamed milk', 'category' => 'Hot Drinks', 'price' => 4.50],
        ],
    ];

    private array $moodMap = [
        'tired' => ['Espresso', 'Americano', 'Cold Brew', 'Hot Latte'],
        'relax' => ['Chai Latte', 'Matcha Latte', 'Herbal Tea', 'Hot Chocolate'],
        'sweet' => ['Vanilla Latte', 'Caramel Macchiato', 'Mocha', 'Frappuccino', 'Hot Chocolate'],
        'energetic' => ['Espresso', 'Americano', 'Cold Brew', 'Matcha Latte'],
        'sad' => ['Hot Chocolate', 'Caramel Macchiato'],
        'stressed' => ['Chai Latte', 'Herbal Tea', 'Matcha Latte', 'Hot Latte'],
        'happy' => ['Frappuccino', 'Iced Latte', 'Mocha', 'Caramel Macchiato'],
    ];

    private array $timeMap = [
        'morning' => ['Hot Latte', 'Cappuccino', 'Espresso', 'Americano', 'Matcha Latte'],
        'afternoon' => ['Iced Latte', 'Iced Tea', 'Cold Brew', 'Chai Latte', 'Matcha Latte'],
        'evening' => ['Decaf Latte', 'Herbal Tea', 'Hot Chocolate', 'Decaf Americano'],
    ];

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getRecommendations(?string $userInput = null, ?float $latitude = null, ?float $longitude = null): array
    {
        $weather = $this->weatherService->getCurrentWeather($latitude, $longitude);
        $timeOfDay = $this->getTimeOfDay((int) date('H'));
        $mood = $this->detectMood($userInput ?? '');

        // Try to get menu items from database
        $menuItems = $this->getMenuItemsFromDatabase();

        $recommendations = [];
        $reason = [];

        // Get weather-based recommendations
        if ($this->weatherService->isRainy($weather['code'])) {
            $category = 'Hot Drinks';
            $recommendations = $this->getMenuItemsByCategory($menuItems, $category, 3);
            $reason[] = "It's rainy outside — cozy drinks recommended!";

            if (empty($recommendations)) {
                $recommendations = $this->drinks['hot'];
            }
        } elseif ($this->weatherService->isHot($weather['temperature'])) {
            $category = 'Cold Drinks';
            $recommendations = $this->getMenuItemsByCategory($menuItems, $category, 3);
            $reason[] = "It's hot (".round($weather['temperature']).'°C) — cool down with our cold drinks!';

            if (empty($recommendations)) {
                $recommendations = $this->drinks['cold'];
            }
        } elseif ($this->weatherService->isCold($weather['temperature'])) {
            $category = 'Hot Drinks';
            $recommendations = $this->getMenuItemsByCategory($menuItems, $category, 3);
            $reason[] = "It's cold (".round($weather['temperature']).'°C) — warm up with our hot drinks!';

            if (empty($recommendations)) {
                $recommendations = $this->drinks['hot'];
            }
        } else {
            $recommendations = $this->getSpecialtyDrinks($menuItems, 3);
            $reason[] = 'Perfect weather — try our specialty drinks!';

            if (empty($recommendations)) {
                $recommendations = $this->drinks['specialty'];
            }
        }

        // Add mood-based recommendations
        if ($mood && isset($this->moodMap[$mood])) {
            $moodItems = $this->getMenuItemsByNames($menuItems, $this->moodMap[$mood], 2);
            if (! empty($moodItems)) {
                $recommendations = array_merge($moodItems, $recommendations);
                $reason[] = 'Based on your mood: '.ucfirst($mood);
            }
        }

        // Add time-based recommendations
        $timeItems = $timeOfDay === 'evening'
            ? $this->getEveningDrinks($menuItems, 2)
            : $this->getMenuItemsByNames($menuItems, $this->timeMap[$timeOfDay], 2);

        if (! empty($timeItems)) {
            $recommendations = array_merge($timeItems, $recommendations);
        }

        // Remove duplicates
        $seen = [];
        $recommendations = array_values(array_filter($recommendations, function ($d) use (&$seen) {
            $name = is_array($d) ? ($d['name'] ?? '') : ($d->name ?? '');
            if (isset($seen[$name])) {
                return false;
            }
            $seen[$name] = true;

            return true;
        }));

        if (count($recommendations) > 6) {
            $recommendations = array_slice($recommendations, 0, 6);
        }

        return [
            'recommendations' => $recommendations,
            'reason' => implode(' ', $reason),
            'weather' => $weather,
            'time_of_day' => $timeOfDay,
            'detected_mood' => $mood,
        ];
    }

    private function getMenuItemsFromDatabase(): array
    {
        try {
            return MenuItem::where('is_available', true)
                ->with('category')
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getMenuItemsByCategory(array $menuItems, string $category, int $limit = 3): array
    {
        $filtered = array_filter($menuItems, function ($item) use ($category) {
            $itemCategory = is_array($item) ? ($item['category']['name'] ?? '') : ($item->category->name ?? '');

            return $itemCategory === $category;
        });

        return array_slice(array_values($filtered), 0, $limit);
    }

    private function getMenuItemsByNames(array $menuItems, array $names, int $limit = 3): array
    {
        $filtered = array_filter($menuItems, function ($item) use ($names) {
            $itemName = is_array($item) ? ($item['name'] ?? '') : ($item->name ?? '');

            return in_array($itemName, $names);
        });

        return array_slice(array_values($filtered), 0, $limit);
    }

    private function getSpecialtyDrinks(array $menuItems, int $limit = 3): array
    {
        $categoryNames = ['Specialty', 'Signature', 'Premium'];
        $filtered = array_filter($menuItems, function ($item) use ($categoryNames) {
            $itemCategory = is_array($item) ? ($item['category']['name'] ?? '') : ($item->category->name ?? '');

            return in_array($itemCategory, $categoryNames);
        });

        return array_slice(array_values($filtered), 0, $limit);
    }

    private function getEveningDrinks(array $menuItems, int $limit = 2): array
    {
        // For evening, try to get decaf or non-caffeinated options
        $filtered = array_filter($menuItems, function ($item) {
            $itemName = is_array($item) ? ($item['name'] ?? '') : ($item->name ?? '');
            $nameLower = strtolower($itemName);

            return str_contains($nameLower, 'decaf') || str_contains($nameLower, 'herbal') || str_contains($nameLower, 'hot chocolate');
        });

        return array_slice(array_values($filtered), 0, $limit);
    }

    public function getAllDrinks(): array
    {
        // Try database first
        try {
            $menuItems = MenuItem::where('is_available', true)
                ->with('category')
                ->get();

            if ($menuItems->isNotEmpty()) {
                return $menuItems->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'description' => $item->description,
                        'category' => $item->category->name ?? 'Uncategorized',
                        'price' => $item->price,
                    ];
                })->toArray();
            }
        } catch (\Exception $e) {
            // Fall back to hardcoded
        }

        return array_merge(...array_values($this->drinks));
    }

    public function searchDrinks(string $query): array
    {
        $query = strtolower(trim($query));

        // Try database first
        try {
            $menuItems = MenuItem::where('is_available', true)
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->with('category')
                ->get();

            if ($menuItems->isNotEmpty()) {
                return $menuItems->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'description' => $item->description,
                        'category' => $item->category->name ?? 'Uncategorized',
                        'price' => $item->price,
                    ];
                })->toArray();
            }
        } catch (\Exception $e) {
            // Fall back to hardcoded
        }

        $allDrinks = $this->getAllDrinks();

        return array_filter($allDrinks, function ($drink) use ($query) {
            return str_contains(strtolower($drink['name']), $query) ||
                   str_contains(strtolower($drink['description']), $query) ||
                   str_contains(strtolower($drink['category']), $query);
        });
    }

    private function getTimeOfDay(int $hour): string
    {
        if ($hour >= 6 && $hour < 11) {
            return 'morning';
        }
        if ($hour >= 11 && $hour < 17) {
            return 'afternoon';
        }

        return 'evening';
    }

    private function detectMood(string $input): ?string
    {
        if (empty(trim($input))) {
            return null;
        }

        $input = strtolower(trim($input));

        $moodPatterns = [
            'tired' => ['tired', 'exhausted', 'sleepy', 'drowsy', 'fatigue', 'energy', 'boost', 'wake', 'focus'],
            'relax' => ['relax', 'relaxing', 'calm', 'chill', 'peaceful', 'unwind', 'stress', 'stressed', 'anxious', 'worried', 'pressure'],
            'sweet' => ['sweet', 'sugar', 'craving', 'dessert', 'treat', 'indulge', 'something sweet'],
            'energetic' => ['energetic', 'active', 'workout', 'energy', 'pick me up'],
            'sad' => ['sad', 'down', 'upset', 'blue', 'gloomy'],
            'happy' => ['happy', 'celebrate', 'good news', 'excited'],
        ];

        foreach ($moodPatterns as $mood => $patterns) {
            foreach ($patterns as $pattern) {
                if (str_contains($input, $pattern)) {
                    return $mood;
                }
            }
        }

        return null;
    }

    private function filterDrinksByNames(array $names): array
    {
        $allDrinks = $this->getAllDrinks();

        return array_filter($allDrinks, function ($drink) use ($names) {
            return in_array($drink['name'], $names);
        });
    }
}
