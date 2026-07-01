<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Us | Educenter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --edu-navy: #1a1c3d; /* Admin Suite Navy */
            --edu-yellow: #ffbc06; /* Educenter Yellow */
        }
        <script>

    const name = document.querySelector('input[placeholder="Axita"]');
    const email = document.querySelector('input[placeholder="example@gmail.com"]');
    const subject = document.querySelector('input[placeholder="MCA Project Inquiry"]');
    const message = document.querySelector('textarea');
    const btn = e.target.querySelector('button');

    let isValid = true;

    document.querySelectorAll('.error-msg').forEach(el => el.remove());

        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }

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

        /* Input Styling */
        .form-control-custom {
            border: 2px solid #e2e8f0;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .form-control-custom:focus {
            border-color: var(--edu-yellow);
            box-shadow: none;
            outline: none;
        }

        .contact-info-card {
            background: var(--edu-navy);
            color: white;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
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
                <a href="{{ url('about') }}" class="nav-link-custom">About</a>
                <a href="{{ url('courses') }}" class="nav-link-custom">Courses</a>
                <a href="{{ url('contact') }}" class="nav-link-custom text-yellow-500">Contact</a>
            </nav>

            <a href="{{ url('/login') }}" class="bg-[#1a1c3d] text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-yellow-500 transition">
                Portal Login
            </a>
        </div>
    </header>



    <footer class="py-10 bg-white border-t text-center text-gray-400 font-bold text-xs uppercase tracking-widest">
        &copy; 2026 EDUCENTER | MCA PROJECT BY DARSHAN
    </footer>

</body>
</html>
