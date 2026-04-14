<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-wrap -mx-3  gap-5 md:gap-0"> <!-- wrapper -->
            <!-- Card 1 -->
            <div class="w-full sm:w-1/2 lg:w-1/4 px-3">
                <x-stat-card
                    title="Members"
                    :model="\App\Models\Member::class"
                    color="blue"
                    icon='<i class="fas fa-users text-4xl"></i>'
                    route="members.index"
                />
            </div>

            <!-- Card 2 -->
            <div class="w-full sm:w-1/2 lg:w-1/4 px-3">
                <x-stat-card
                    title="Pastors"
                    :model="\App\Models\Pastor::class"
                    color="green"
                    icon='<i class="fas fa-user-tie text-4xl"></i>'
                    route="members.index"
                />
            </div>

            <!-- Card 3 -->
            <div class="w-full sm:w-1/2 lg:w-1/4 px-3">
                <x-stat-card
                    title="Giving"
                    :model="\App\Models\Giving::class"
                    color="yellow"
                    icon='<i class="fas fa-coins text-4xl"></i>'
                    route="givings.index"
                />
            </div>

            <!-- Card 4 -->
            <div class="w-full sm:w-1/2 lg:w-1/4 px-3">
                <x-stat-card
                    title="Churches"
                    :model="\App\Models\Church::class"
                    color="purple"
                    icon='<i class="fas fa-church text-4xl"></i>'
                    route="churches.index"
                />
            </div>

        </div>
          <!-- Second row: 3 columns -->
       <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">

    <x-stat-card
        title="WEF"
        :model="\App\Models\Giving::class"
        color="red"
        icon='<i class="fas fa-wallet text-4xl"></i>'
        route="givings.index"
        typeFilter="WEF"
        sumColumn="amount"
    />

    <x-stat-card
        title="Education"
        :model="\App\Models\Giving::class"
        color="indigo"
        icon='<i class="fas fa-graduation-cap text-4xl"></i>'
        route="givings.index"
        typeFilter="Education"
        sumColumn="amount"
    />

    <x-stat-card
        title="District Budget"
        :model="\App\Models\Giving::class"
        color="orange"
        icon='<i class="fas fa-peso-sign text-4xl"></i>'
        route="givings.index"
        typeFilter="districtBudget"
        sumColumn="amount"
    />

</div>
</div>
</x-app-layout>
