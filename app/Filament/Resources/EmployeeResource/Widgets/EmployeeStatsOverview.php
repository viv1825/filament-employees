<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Employee;
use App\Models\Country;
use Illuminate\Support\Carbon;

class EmployeeStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Define the time period for "recent"
        $recentPeriod = Carbon::now()->subDays(7);
        $recentEmployeesCount = Employee::where('date_hired', '>=', $recentPeriod)->count();

        // Fetch the country with the most employees
        $countryWithMostEmployees = Employee::selectRaw('country_id, COUNT(*) as count')
            ->groupBy('country_id')
            ->orderByDesc('count')
            ->first();

        $countryName = $countryWithMostEmployees 
            ? Country::find($countryWithMostEmployees->country_id)->name 
            : 'N/A';

        return [
            Stat::make('Total Employees', Employee::all()->count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Recent Employees', $recentEmployeesCount)
                ->description('Employees joined in the last week')
                ->color('primary'),

                Stat::make('Country with Most Employees', $countryName)
                // ->description('Country with the highest number of employees')
                ->color('info'),

            // Stat::make('Average time on page', '3:12'),
        ];
    }
}
