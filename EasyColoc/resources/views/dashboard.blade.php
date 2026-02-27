<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc Home - My Colocations</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2b8cee",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .avatar-stack {
                @apply flex -space-x-2 overflow-hidden;
            }
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <header
                class="flex items-center justify-between whitespace-nowrap border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 md:px-20 py-3 sticky top-0 z-50">
                <div class="flex items-center gap-3">
                    <div class="size-8 bg-primary text-white rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">account_balance_wallet</span>
                    </div>
                    <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold leading-tight tracking-tight">
                        EasyColoc</h2>
                </div>
                <div class="flex flex-1 justify-end gap-6 items-center">
                    <nav class="hidden md:flex items-center gap-8">
                        <a class="text-primary text-sm font-bold transition-colors border-b-2 border-primary pb-1"
                            href="#">My Colocs</a>
                        <a class="text-slate-700 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
                            href="{route::}">Profile</a>
                        <a class="text-slate-700 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
                            href="#">Logout</a>
                    </nav>
                    <button
                        class="flex min-w-[40px] md:min-w-[140px] cursor-pointer items-center justify-center gap-2 rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal transition-all hover:shadow-lg hover:shadow-primary/20">
                        <span class="material-symbols-outlined text-lg">add_circle</span>
                        <span class="hidden md:inline">New Coloc</span>
                    </button>
                </div>
            </header>
            <main class="flex flex-1 justify-center py-8 md:py-12">
                <div class="layout-content-container flex flex-col max-w-[1100px] flex-1 px-4 md:px-10">
                    <div class="flex flex-col gap-2 mb-10">
                       <h1 class="text-slate-900 dark:text-slate-100 text-3xl md:text-4xl font-black leading-tight tracking-tight">
    Welcome back, {{ auth()->user()->name }}!
</h1>
<p class="text-slate-500 dark:text-slate-400 text-lg font-normal">
    You are part of {{ $allColocs->count() ?? 0 }} active colocations.
</p>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">Your Colocations
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <button onclick="document.getElementById('newColocModal').classList.remove('hidden')"
                            class="group flex flex-col items-center justify-center gap-4 rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-700 p-8 hover:border-primary hover:bg-primary/5 transition-all cursor-pointer min-h-[220px]">
                            <div
                                class="size-14 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 group-hover:bg-primary group-hover:text-white transition-all">
                                <span class="material-symbols-outlined text-3xl">add</span>
                            </div>
                            <div class="text-center">
                                <h3 class="text-slate-900 dark:text-slate-100 font-bold">Create New</h3>
                                <p class="text-slate-500 text-sm">Add a new shared space</p>
                            </div>
                        </button>
                        <div id="newColocModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Create New Colocation</h3>
        <form method="POST" action="{{ route('colocations.store') }}">
            @csrf
            <div class="flex flex-col gap-4">
                <input name="name" placeholder="Colocation Name" class="w-full px-4 py-2 border rounded-lg" required>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Create</button>
            </div>
        </form>
        <button onclick="document.getElementById('newColocModal').classList.add('hidden')" class="mt-4 text-sm text-red-500">Cancel</button>
    </div>
</div>
                      @foreach($allColocs as $coloc)
<div
    class="group flex flex-col rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all overflow-hidden">
    <div class="p-6 flex flex-col h-full">

        <!-- Header: Icon + Role / Status -->
        <div class="flex justify-between items-start mb-4">
            <div class="size-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                <span class="material-symbols-outlined">apartment</span>
            </div>
            <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">
                {{ $coloc->pivot->role ?? 'Owner' }}
            </span>
        </div>

        <!-- Colocation Name -->
        <h3 class="text-slate-900 dark:text-slate-100 text-xl font-bold mb-2">{{ $coloc->name }}</h3>

        <!-- Members avatars -->
        <div class="flex items-center gap-3 mb-6">
            <div class="avatar-stack">
                @foreach($coloc->users as $user)
                    <img alt="{{ $user->name }}"
                        class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-slate-900 object-cover"
                        src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . $user->name }}">
                @endforeach
            </div>
            <span class="text-slate-400 text-sm">{{ $coloc->users->count() }} Members</span>
        </div>

        <!-- Footer: Balance + Dashboard link -->
        <div class="mt-auto pt-6 border-t border-slate-100 dark:border-slate-800">
            <div class="flex justify-between items-center">
                <div class="flex flex-col">

                </div>
                <a class="flex items-center gap-1 text-primary text-sm font-bold group-hover:translate-x-1 transition-transform"
                   href="{{ route('colocations.show', $coloc) }}"
                   >
                    View Dashboard
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endforeach
                        <div
                            class="group flex flex-col rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all overflow-hidden">
                            <div class="p-6 flex flex-col h-full">
                                <div class="flex justify-between items-start mb-4">
                                    <div
                                        class="size-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                                        <span class="material-symbols-outlined">apartment</span>
                                    </div>
                                    <span
                                        class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Active</span>
                                </div>
                                <h3 class="text-slate-900 dark:text-slate-100 text-xl font-bold mb-2">Summer Beach House
                                </h3>
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="avatar-stack">
                                        <img alt="Member 1"
                                            class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-slate-900 object-cover"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_saq_LcZfigv0j-u_9QSo7bSwpUu52tIww-fCTsnfDF2hopmDmF_8cqlVbhzNBzuzVJSN9C1CwBXHOYqTUbleJPa1SdPIhEcWIVDaS3IWHrmsPnVyANVbTp72Z442nvUXgBdBJdiu8EG9UcrHWHl3OS53uyGZo9osAOV6RMy3ZpG8D8V3Gx_jNvwhRGdPTpa5vkoJpWo9ijdhz3eR9z0mzFfHohCdlrO0vKUfnzNRLXXgMo-UxwTy5pTa9EtHUzbZSektTHOSsl3f" />
                                        <img alt="Member 2"
                                            class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-slate-900 object-cover"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuArdXQFubBlnoYT-7ZI8RcpwkxMqkt90kv-bQohuMzbMDFtJD1fuDIGQfyhrlb_iwBdPb40b74_Pq9g2VzBAVqJhqplGO6_HOlxJkBBxK5UbVrm4G0EX_qhlC4pKKZECEkmOaZlSBj3UEOGuHLQOQSA3AAt88UQCAZXV89HEGSYAls5f3LE-hSXAsvBIaFM0iU0YTnPxCk8lpN4O6gcN3ltJxK5JowBlAR2iE_YvO8gwy2Vxl5SCRJLqicJ99fk5JC1iD_37Aixr8sr" />
                                    </div>
                                    <span class="text-slate-400 text-sm">2 Members</span>
                                </div>
                                <div class="mt-auto pt-6 border-t border-slate-100 dark:border-slate-800">
                                    <div class="flex justify-between items-center">
                                        <div class="flex flex-col">
                                            <span class="text-slate-400 text-[10px] font-bold uppercase">Balance</span>
                                            <span class="text-rose-500 font-bold">-$12.40</span>
                                        </div>
                                        <a class="flex items-center gap-1 text-primary text-sm font-bold group-hover:translate-x-1 transition-transform"
                                            href="#">
                                            View Dashboard
                                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="group flex flex-col rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all overflow-hidden">
                            <div class="p-6 flex flex-col h-full">
                                <div class="flex justify-between items-start mb-4">
                                    <div
                                        class="size-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                                        <span class="material-symbols-outlined">cottage</span>
                                    </div>
                                    <span
                                        class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Pending</span>
                                </div>
                                <h3 class="text-slate-900 dark:text-slate-100 text-xl font-bold mb-2">Campus Studio B
                                </h3>
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="avatar-stack">
                                        <img alt="Member 1"
                                            class="inline-block h-8 w-8 rounded-full ring-2 ring-white dark:ring-slate-900 object-cover"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCpDYdiL9bh5DDtai89F6e_xAroWusBKJwWIEfJ6ij97gGTtRSzOrGKLqU7qWNt8eA1gws2HQ9okwiNf6VsC7zJndaFkpQTmYQ4pg4eFGP5V1V7rekT3Et9TNcP1ki2D2VyGk5co5j7w2DLpqdpXY28BrnWmq4aA2RQIuoLIq5KfOvPNwUKl4ZBGiSPRhlNl5Z_C-lR57nD19nXaUWMa6ly42_PKavhwIMzl5Ls4XS30TJsYrZPla_7rDvod8qvpvuoBj05xh_QmuP3" />
                                    </div>
                                    <span class="text-slate-400 text-sm">1 Member</span>
                                </div>
                                <div class="mt-auto pt-6 border-t border-slate-100 dark:border-slate-800">
                                    <div class="flex justify-between items-center">
                                        <div class="flex flex-col">
                                            <span class="text-slate-400 text-[10px] font-bold uppercase">Balance</span>
                                            <span class="text-slate-500 font-bold">$0.00</span>
                                        </div>
                                        <a class="flex items-center gap-1 text-primary text-sm font-bold group-hover:translate-x-1 transition-transform"
                                            href="#">
                                            View Dashboard
                                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="mt-auto py-10 border-t border-slate-200 dark:border-slate-800 text-center">
                <p class="text-slate-400 text-xs">© 2023 EasyColoc Management System. All rights reserved.</p>
            </footer>
        </div>
    </div>

</body>

</html>
