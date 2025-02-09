<?php

namespace App\Filament\Student\Widgets;

use App\Models\Status;
use App\Models\Subject;
use App\Models\Task;
use Filament\Facades\Filament;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class TaskCalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Task::class;

    public function config(): array
    {
        return [
            'timezone' => 'UTC',
            'initialView' => 'listWeek',
            'headerToolbar' => [
                'left' => 'prev,today,next',
                'center' => 'title',
                'right' => 'dayGridMonth,listWeek'
            ],
            'noEventsContent' => 'There are no tasks due this week.',
            'forceEventDuration' => true,
            'defaultTimedEventDuration' => '00:00'
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        $userid = Filament::auth()->id();
        return Task::query()
        ->where('user_id', $userid)
        ->where('deadline', '>=', $fetchInfo['start'])
        ->where('deadline', '<=', $fetchInfo['end'])
        ->whereNotNull('deadline')
        ->whereNot('status_id', 4)
        ->get() 
        ->map(
            fn (Task $task) => EventData::make()
            ->id($task->id)
            ->title($task->name)
            ->start($task->deadline)
            ->extendedProps([
                'status_id' => $task->status_id,
                'description' => $task->description,
            ])
        )
        ->toArray();
    }

    public function getFormSchema(): array
    {
        $userid = Filament::auth()->id();        
        return [
            //
            Forms\Components\TextInput::make('name')
            ->required(),
            Forms\Components\Textarea::make('description')
            ->required(),
            Forms\Components\Select::make('subject_id')
            ->required()
            ->options(Subject::where('user_id', $userid)->pluck('name', 'id')),
            Forms\Components\DateTimePicker::make('deadline')
            ->seconds(false)
            ->default(now()->endOfDay()),
            Forms\Components\Select::make('status_id')
            ->required()
            ->options(Status::where('name', 'regexp', '^(Task-)(\w+)')->pluck('name', 'id')),
        ];
    }
}
