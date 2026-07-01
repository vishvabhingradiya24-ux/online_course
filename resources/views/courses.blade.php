<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Our Courses | Educenter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --edu-navy: #1a1c3d;
            --edu-yellow: #ffbc06;
        }

        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }

        /* Matching Header */
        .header-main {
            background-color: white;
            border-bottom: 3px solid var(--edu-yellow);
        }

        .nav-link-custom {
            color: var(--edu-navy);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
        }

        /* Course Card Styling */
        .course-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.4s;
            border: 1px solid #e2e8f0;
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(26, 28, 61, 0.1);
        }

        .course-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .category-badge {
            background-color: var(--edu-yellow);
            color: var(--edu-navy);
            font-size: 10px;
            font-weight: 900;
            padding: 4px 12px;
            border-radius: 50px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <header class="header-main sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center shadow-md">
                    <span class="text-navy-900 font-black text-xl">e</span>
                </div>
                <h2 class="text-2xl font-black italic text-[#1a1c3d]">edu<span class="text-yellow-500">center</span></h2>
            </div>

            <nav class="hidden md:flex gap-8">
                <a href="{{ url('/') }}" class="nav-link-custom">Home</a>
                <a href="{{ url('/about') }}" class="nav-link-custom">About</a>
                <a href="{{ url('/courses') }}" class="nav-link-custom text-yellow-500">Courses</a>
                <a href="{{ url('/contact') }}" class="nav-link-custom">Contact</a>
            </nav>

            <a href="{{ url('/login') }}" class="bg-[#1a1c3d] text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-yellow-500 transition">Portal Login</a>
        </div>
    </header>


    <footer class="py-10 bg-white border-t text-center text-gray-400 font-bold text-xs uppercase tracking-widest">
        &copy; 2026 EDUCENTER | MCA PROJECT BY AXITA
    </footer>

</body>
</html>
