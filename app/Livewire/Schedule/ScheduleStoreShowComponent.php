<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class ScheduleStoreShowComponent extends Component
{
    public $opening = '08:00';
    public $closing = '21:00';

    // These optional fields, depending on whether the store has a divided schedule.
    public $openingOptional = '08:00';
    public $closingOptional = '21:00';

    public $schedules = [];

    public $viewOptionalSchedules = false;

    public $listeners = ['updateSelectedSchedule'];

    /**
     * Validation rules for schedule creation.
     *
     * @return void
     */
    protected function rules()
    {
        return [
            'opening' => 'required',
            'closing' => 'required',
        ];
    }

    public function updateSelectedSchedule()
    {
        dd('dd');
    }

    public function viewHiddenInformation()
    {
        $this->viewOptionalSchedules = !$this->viewOptionalSchedules;
    }

    public function addShield()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'days' => ['Lu', 'Ma', 'Mie', 'Ju', 'Vi', 'Sa', 'Do'],
            'selectDays' => [],
            'opening' => '08:00',
            'closing' => '21:00',
            'openingOptional' => '08:00',
            'closingOptional' => '21:00',
        ];

        $this->schedules[$newKey] = $newShield;
    }

    public function removeShield($key)
    {
        $nowCount = count($this->schedules);
        if ($nowCount === 1) {
            session()->flash('scheduleMessage', 'El horario debe poseer al menos una jornada.');
        } else {
            unset($this->schedules[$key]);
            $auxSchedules = $this->schedules;
            $this->reset('schedules');
            $this->schedules = $auxSchedules;
        }
    }

    public function mount()
    {
        $newKey = uniqid();
        $newShield = [
            'key' => $newKey,
            'days' => ['Lu', 'Ma', 'Mie', 'Ju', 'Vi', 'Sa', 'Do'],
            'selectDays' => [],
            'opening' => '08:00',
            'closing' => '21:00',
            'openingOptional' => '08:00',
            'closingOptional' => '21:00',
        ];
        $this->schedules[$newKey] = $newShield;
    }

    public function save()
    {
        dd($this->schedules);
        // $this->validate();
        // dd($this->opening, $this->closing, $this->openingOptional, $this->closingOptional);
    }

    public function render()
    {
        return view('livewire.schedule.schedule-store-show-component');
    }
}
