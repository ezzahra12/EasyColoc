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
                        <form action="{{ route('colocations.leave', $colocation->id) }}" method="POST" class="mt-4">
    @csrf
    <button type="submit"
        class="px-4 py-2 rounded-lg bg-rose-500 text-white font-bold hover:bg-rose-600 transition-colors">
        Leave Colocation
    </button>
</form>
                    </nav>
                    <button id="openAddExpenseModal"
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
                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Expenses</p>
                            <p class="text-slate-900 dark:text-slate-100 text-2xl font-bold tracking-tight">
                                ${{ number_format($colocation->expenses->sum('amount'), 2) }}
                            </p>
                        </div>

                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-primary/10 dark:bg-primary/20 border border-primary/20 dark:border-primary/30">
                            <p class="text-primary text-sm font-medium">My Balance</p>
                            <p class="text-primary text-2xl font-bold tracking-tight">
                                ${{ number_format(auth()->user()->balance($colocation), 2) }}
                            </p>
                            <p class="mt-2 text-primary/70 text-xs font-semibold uppercase tracking-wider">Settled up
                            </p>
                        </div>

                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">I Owe</p>
                            <p class="text-rose-500 text-2xl font-bold tracking-tight">
                                {{-- ${{ number_format(auth()->user()->iOwe($colocation), 2) }} --}}
                            </p>
                            {{-- <div class="mt-2 text-slate-400 text-xs">To {{ auth()->user()->iOweUsers($colocation)->count() }} roommates</div> --}}
                        </div>

                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">I Am Owed</p>
                            <p class="text-emerald-500 text-2xl font-bold tracking-tight">
                                {{-- ${{ number_format(auth()->user()->iAmOwed($colocation), 2) }} --}}
                            </p>
                            {{-- <div class="mt-2 text-slate-400 text-xs">From {{ auth()->user()->iAmOwedUsers($colocation)->count() }} roommates</div> --}}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left: Who Owes Who -->
                        <div class="flex flex-col gap-3">
                            @foreach ($colocation->users as $user)
                                @if ($user->id !== auth()->id())
                                    <div
                                        class="flex items-center gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 transition-all hover:shadow-md">
                                        <div
                                            class="bg-primary/20 size-12 rounded-full flex items-center justify-center text-primary overflow-hidden">
                                            @if ($user->profile_photo_url)
                                                <img class="w-full h-full object-cover"
                                                    src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                            @else
                                                <div
                                                    class="bg-primary text-[10px] text-white flex items-center justify-center w-full h-full font-bold">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <h3 class="text-slate-900 dark:text-slate-100 text-sm font-bold">
                                                @if ($user->balance($colocation) > 0)
                                                    {{ $user->name }} owes you
                                                @else
                                                    You owe {{ $user->name }}
                                                @endif
                                            </h3>
                                            <p
                                                class="{{ $user->balance($colocation) > 0 ? 'text-emerald-600' : 'text-rose-500' }} text-xs font-medium">
                                                ${{ number_format(abs($user->balance($colocation)), 2) }}
                                            </p>
                                        </div>
                                        <span
                                            class="material-symbols-outlined ml-auto text-slate-300">chevron_right</span>
                                    </div>
                                @endif
                            @endforeach
                            @if(auth()->id() === $colocation->owner_id)

<div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
    <div class="flex items-center gap-3 mb-4">
        <div class="p-2 bg-primary/10 rounded-lg">
            <span class="material-symbols-outlined text-primary">person_add</span>
        </div>
        <h2 class="text-slate-900 dark:text-white text-xl font-bold">Invite Member</h2>
    </div>

    <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">
        Send an email invitation to your future flatmate.
    </p>

    <form method="POST" action="{{ route('invitations.send', $colocation->id) }}">
        @csrf
        <div class="flex items-center gap-2">
            <input
                type="email"
                name="email"
                required
                placeholder="Enter roommate email"
                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-900 dark:text-white"
            />

            <button type="submit"
                class="bg-primary text-white font-bold py-2.5 px-6 rounded-lg">
                Send
            </button>
        </div>
    </form>
</div>

@endif
                        </div>
                        @if(auth()->id() === $colocation->owner_id)
<div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm mb-6">
    <div class="flex items-center gap-3 mb-4">
        <div class="p-2 bg-primary/10 rounded-lg">
            <span class="material-symbols-outlined text-primary">category</span>
        </div>
        <h2 class="text-slate-900 dark:text-white text-xl font-bold">Add New Category</h2>
    </div>

    <form action="{{ route('categories.store') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="name" placeholder="New category name"
            class="flex-1 block w-full py-3 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
            required>
        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
        <button type="submit"
            class="px-6 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary/90 transition-all">
            Add
        </button>
    </form>
</div>
@endif
                        <!-- Right: Expenses Table -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center justify-between mb-4 px-2">
                                <h2 class="text-slate-900 dark:text-slate-100 text-xl font-bold tracking-tight">Recent
                                    Expenses</h2>
                                <button
                                    class="text-slate-500 dark:text-slate-400 text-sm font-medium flex items-center gap-1 hover:text-primary transition-colors">
                                    <span>View all</span>
                                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                                </button>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr
                                            class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                            <th
                                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                                Expense</th>
                                            <th
                                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                                Category</th>
                                            <th
                                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                                Payer</th>
                                            <th
                                                class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-right">
                                                Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                        @forelse($expenses as $expense)
                                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">

                                                {{-- Expense Title + Date --}}
                                                <td class="px-6 py-4">
                                                    <div class="flex flex-col">
                                                        <span
                                                            class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                                            {{ $expense->title }}
                                                        </span>
                                                        <span class="text-xs text-slate-500">
                                                            {{ $expense->created_at->format('M d, Y') }}
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Category --}}
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300">
                                                        {{ $expense->category->name }}
                                                    </span>
                                                </td>

                                                {{-- Payer --}}
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-2">
                                                        <div class="size-6 rounded-full bg-slate-200 overflow-hidden">
                                                            <div
                                                                class="bg-primary text-[10px] text-white flex items-center justify-center w-full h-full font-bold">
                                                                {{ strtoupper(substr($expense->payer->name, 0, 2)) }}
                                                            </div>
                                                        </div>

                                                        <span class="text-sm text-slate-700 dark:text-slate-300">
                                                            {{ $expense->payer->id === auth()->id() ? 'You' : $expense->payer->name }}
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Amount --}}
                                                <td
                                                    class="px-6 py-4 text-right font-bold text-slate-900 dark:text-slate-100">
                                                    ${{ number_format($expense->amount, 2) }}
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-6 text-slate-500">
                                                    No expenses yet for this colocation.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- <div
                                    class="px-6 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-200 dark:border-slate-800 text-center">
                                    <button
                                        class="text-sm font-semibold text-primary hover:text-primary/80 transition-colors">Load
                                        more history</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <footer class="mt-auto py-10 border-t border-slate-200 dark:border-slate-800 text-center">
                <p class="text-slate-400 text-xs">© 2023 EasyColoc Management System. All rights reserved.</p>
            </footer>
        </div>
    </div>
    <!-- Modal Overlay -->
   <!-- Modal Overlay -->
<div id="addExpenseModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4 hidden">
    <!-- Modal Container -->
    <div
        class="relative w-full max-w-lg bg-background-light dark:bg-slate-900 rounded-2xl shadow-2xl overflow-hidden border border-white/20">

        <!-- Modal Header -->
        <div class="px-8 pt-8 pb-4 flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100 leading-tight">Add New Expense</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Split costs with your roommates easily.</p>
            </div>
            <a href="{{ url()->previous() }}"
                class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </a>
        </div>

        <!-- Modal Content -->
        <form action="{{ route('expenses.store', $colocation->id) }}" method="POST" class="px-8 py-4 space-y-6">
            @csrf

            <!-- Expense Title -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">What did you pay for?</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span
                            class="material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors">shopping_cart</span>
                    </div>
                    <input type="text" name="title" placeholder="e.g., Weekly Groceries at Lidl"
                        class="block w-full pl-11 pr-4 py-3.5 bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                        required>
                </div>
            </div>

            <!-- Amount and Date Grid -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Amount -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Amount</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span
                                class="material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors">payments</span>
                        </div>
                        <input type="number" name="amount" placeholder="0.00" step="0.01"
                            class="block w-full pl-11 pr-4 py-3.5 bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                            required>
                    </div>
                </div>

                <!-- Date -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Date</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span
                                class="material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors">calendar_today</span>
                        </div>
                        <input type="date" name="date"
                            class="block w-full pl-11 pr-4 py-3.5 bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                            required>
                    </div>
                </div>
            </div>

            <!-- Category Selection -->
            <div class="space-y-3">
                <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1">Category</label>
                <select name="category_id"
                    class="block w-full py-3.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                    required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Roommate Selection (Hidden for PHP dynamic) -->
            @foreach($colocation->users as $user)
                <input type="hidden" name="members[]" value="{{ $user->id }}">
            @endforeach

            <!-- Modal Footer -->
            <div class="px-0 py-6 mt-4 bg-slate-50 dark:bg-slate-800/50 flex flex-col sm:flex-row gap-3">
                <a href="{{ url()->previous() }}"
                    class="flex-1 order-2 sm:order-1 px-6 py-3.5 rounded-xl font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all text-center">
                    Cancel
                </a>
                <button type="submit"
                    class="flex-[2] order-1 sm:order-2 px-6 py-3.5 rounded-xl font-semibold text-white bg-primary hover:bg-primary/90 shadow-lg shadow-primary/25 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-xl">save</span>
                    Save Expense
                </button>
            </div>
        </form>

    </div>
</div>

        </div>
    </div>
    <script>
      const openBtn = document.getElementById('openAddExpenseModal');
const modal = document.getElementById('addExpenseModal');
const closeBtn = document.getElementById('closeAddExpenseModal');
const cancelBtn = document.getElementById('cancelAddExpense');

openBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
});

closeBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
});

cancelBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
});

    </script>
</body>

</html>
