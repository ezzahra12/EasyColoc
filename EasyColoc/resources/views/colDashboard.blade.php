<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap"
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
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <!-- Navbar -->
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
                        <a class="text-slate-700 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
                            href="#">Colocation</a>
                        <a class="text-slate-700 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
                            href="#">Profile</a>
                        <a class="text-slate-700 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors"
                            href="#">Logout</a>
                    </nav>
                    <button
                        class="flex min-w-[120px] cursor-pointer items-center justify-center gap-2 rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal transition-opacity hover:opacity-90">
                        <span class="material-symbols-outlined text-lg">add_circle</span>
                        <span>Add Expense</span>
                    </button>
                </div>
            </header>
            <main class="flex flex-1 justify-center py-8">
                <div class="layout-content-container flex flex-col max-w-[1100px] flex-1 px-4 md:px-10">
                    <!-- Header Section -->
                    <div class="flex flex-wrap justify-between items-end gap-4 mb-8">
                        <div class="flex flex-col gap-1">
                            <h1
                                class="text-slate-900 dark:text-slate-100 text-4xl font-black leading-tight tracking-tight">
                                Colocation Dashboard</h1>
                            <p class="text-slate-500 dark:text-slate-400 text-base font-normal">Manage your shared
                                expenses and balances for Maple Avenue Apt.</p>
                        </div>
                        <div
                            class="flex items-center gap-2 bg-white dark:bg-slate-800 p-1 rounded-lg border border-slate-200 dark:border-slate-700">
                            <span class="material-symbols-outlined text-slate-400 px-2">calendar_month</span>
                            <select
                                class="bg-transparent border-none text-sm font-medium text-slate-700 dark:text-slate-300 focus:ring-0 cursor-pointer">
                                <option>October 2023</option>
                                <option>September 2023</option>
                                <option>August 2023</option>
                            </select>
                        </div>
                    </div>
                    <!-- Summary Cards -->
                    <!-- Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Expenses</p>
        <p class="text-slate-900 dark:text-slate-100 text-2xl font-bold tracking-tight">
            ${{ number_format($colocation->expenses->sum('amount'), 2) }}
        </p>
    </div>

    <div class="flex flex-col gap-2 rounded-xl p-6 bg-primary/10 dark:bg-primary/20 border border-primary/20 dark:border-primary/30">
        <p class="text-primary text-sm font-medium">My Balance</p>
        <p class="text-primary text-2xl font-bold tracking-tight">
            ${{ number_format(auth()->user()->balance($colocation), 2) }}
        </p>
        <p class="mt-2 text-primary/70 text-xs font-semibold uppercase tracking-wider">Settled up</p>
    </div>

    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">I Owe</p>
        <p class="text-rose-500 text-2xl font-bold tracking-tight">
            {{-- ${{ number_format(auth()->user()->iOwe($colocation), 2) }} --}}
        </p>
        {{-- <div class="mt-2 text-slate-400 text-xs">To {{ auth()->user()->iOweUsers($colocation)->count() }} roommates</div> --}}
    </div>

    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">I Am Owed</p>
        <p class="text-emerald-500 text-2xl font-bold tracking-tight">
            {{-- ${{ number_format(auth()->user()->iAmOwed($colocation), 2) }} --}}
        </p>
        {{-- <div class="mt-2 text-slate-400 text-xs">From {{ auth()->user()->iAmOwedUsers($colocation)->count() }} roommates</div> --}}
    </div>
</div>
                  <div class="flex flex-col gap-3">
    @foreach(auth()->user()->credits()->where('colocation_id', $colocation->id)->get() as $credit)
        <div class="flex items-center gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 transition-all hover:shadow-md">
            <div class="bg-primary/20 size-12 rounded-full flex items-center justify-center text-primary overflow-hidden">
                <img class="w-full h-full object-cover" src="{{ $credit->debtor->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="{{ $credit->debtor->name }}">
            </div>
            <div class="flex flex-col">
                <h3 class="text-slate-900 dark:text-slate-100 text-sm font-bold">
                    {{ $credit->debtor->name }} owes you
                </h3>
                <p class="text-emerald-600 text-xs font-medium">
                    ${{ number_format($credit->amount, 2) }} for {{ $credit->expense->title ?? 'Expense' }}
                </p>
            </div>
            <span class="material-symbols-outlined ml-auto text-slate-300">chevron_right</span>
        </div>
    @endforeach

    @foreach(auth()->user()->debts()->where('colocation_id', $colocation->id)->get() as $debt)
        <div class="flex items-center gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 transition-all hover:shadow-md">
            <div class="bg-primary/20 size-12 rounded-full flex items-center justify-center text-primary overflow-hidden">
                <img class="w-full h-full object-cover" src="{{ $debt->creditor->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="{{ $debt->creditor->name }}">
            </div>
            <div class="flex flex-col">
                <h3 class="text-slate-900 dark:text-slate-100 text-sm font-bold">
                    You owe {{ $debt->creditor->name }}
                </h3>
                <p class="text-rose-500 text-xs font-medium">
                    ${{ number_format($debt->amount, 2) }} for {{ $debt->expense->title ?? 'Expense' }}
                </p>
            </div>
            <span class="material-symbols-outlined ml-auto text-slate-300">chevron_right</span>
        </div>
    @endforeach
</div>
                </div>
            </main>
            <!-- Footer -->
            <footer class="mt-auto py-10 border-t border-slate-200 dark:border-slate-800 text-center">
                <p class="text-slate-400 text-xs">© 2023 EasyColoc Management System. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>

</html>
