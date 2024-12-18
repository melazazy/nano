<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Design',
                'description' => 'Create stunning, responsive websites that capture your brand\'s essence.',
                'icon' => 'fas fa-paint-brush',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Strategic digital marketing solutions to boost your online presence and drive growth.',
                'icon' => 'fas fa-chart-line',
                'image_url' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ],
            [
                'name' => 'App Development',
                'description' => 'Building innovative mobile applications that deliver exceptional user experiences.',
                'icon' => 'fas fa-mobile-alt',
                'image_url' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Creating intuitive and engaging user interfaces with focus on user experience.',
                'icon' => 'fas fa-pencil-ruler',
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ],
            [
                'name' => 'SEO Optimization',
                'description' => 'Improving your website\'s visibility and ranking in search engine results.',
                'icon' => 'fas fa-search',
                'image_url' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}