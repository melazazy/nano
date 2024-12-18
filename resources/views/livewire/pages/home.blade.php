<div>
    <!-- Hero Section -->
    <section id="" class="relative min-h-screen flex items-center" data-aos="fade-up"
             style="background-image: linear-gradient(rgba(31, 41, 55, 0.7), rgba(31, 41, 55, 0.8)),
                    url('{{ asset('assets/img/hero/hero-bg.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    background-attachment: fixed;">
        <div class="absolute inset-0 opacity-90"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-6" data-aos="fade-up">
                    Transform Your Digital Presence
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-300" data-aos="fade-up" data-aos-delay="200">
                    Innovative solutions for modern businesses
                </p>
                <div class="space-x-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="#services"
                       class="inline-block bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-8 py-3 rounded-full hover:shadow-lg transition-all duration-300">
                        Explore Our Services
                    </a>
                    <a href="#contact"
                       class="inline-block border-2 border-white text-white font-semibold px-8 py-3 rounded-full hover:bg-white hover:text-primary-dark transition-all duration-300">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4" data-aos="fade-up">Our Services</h2>
                <p class="text-gray-600 text-lg" data-aos="fade-up" data-aos-delay="100">
                    Transforming ideas into digital excellence
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="service-card group" data-aos="fade-up" data-aos-delay="{{ $service['delay'] }}">
                        <div class="relative overflow-hidden rounded-t-xl">
                            <img src="{{ asset('storage/services/images/' . $service['image']) }}"
                                 alt="{{ $service['title'] }}"
                                 class="w-full h-64 object-cover transform transition-transform duration-500 group-hover:scale-110">
                            <div class="service-icon">
                                <i class="{{ $service['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="p-8 bg-white rounded-b-xl">
                            <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $service['title'] }}</h3>
                            <p class="text-gray-600 mb-6">{{ $service['description'] }}</p>
                            <!-- <a href="#" class="inline-block px-6 py-3 bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold rounded-full hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                Learn More
                            </a> -->
                            <a href="{{ route('request.service', ['service_id' => $service['id']]) }}" 
                                class="inline-block px-6 py-3 bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold rounded-full hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                    Request Service
                                </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-number">500+</div>
                    <div class="stat-text">Clients Served</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-number">1000+</div>
                    <div class="stat-text">Projects Completed</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-number">50+</div>
                    <div class="stat-text">Team Members</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-number">15+</div>
                    <div class="stat-text">Years Experience</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up">Why Choose Us</h2>
                <p class="text-gray-600" data-aos="fade-up" data-aos-delay="200">What sets us apart from the competition</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($features as $feature)
                <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <i class="{{ $feature['icon'] }} text-3xl text-primary-red"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up">Get in Touch</h2>
                <p class="text-gray-600" data-aos="fade-up" data-aos-delay="200">Let's discuss how we can help your business grow</p>
            </div>

            <div class="max-w-2xl mx-auto">
                <form wire:submit.prevent="submitContact" class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 mb-2">Name</label>
                        <input type="text" id="name" wire:model="name"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary-red">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" wire:model="email"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary-red">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 mb-2">Message</label>
                        <textarea id="message" wire:model="message" rows="4"
                                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary-red"></textarea>
                        @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-primary-red to-secondary-red text-white font-semibold px-6 py-3 rounded-lg hover:shadow-lg transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
