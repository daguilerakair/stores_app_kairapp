<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class ScheduleStoreShowComponent extends Component
{
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

    public function viewHiddenInformation($key)
    {
        // dd($this->schedules[$key]['viewOptionalSchedules']);
        $this->schedules[$key]['viewOptionalSchedules'] = !$this->schedules[$key]['viewOptionalSchedules'];
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
            'openingOptional' => '08:00', // These optional fields, depending on whether the store has a divided schedule.
            'closingOptional' => '21:00', // These optional fields, depending on whether the store has a divided schedule.
            'viewOptionalSchedules' => false,
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
            'openingOptional' => '08:00', // These optional fields, depending on whether the store has a divided schedule.
            'closingOptional' => '21:00', // These optional fields, depending on whether the store has a divided schedule.
            'viewOptionalSchedules' => false,
        ];
        $this->schedules[$newKey] = $newShield;
    }

    public function save()
    {
        // dd($this->schedules);
        $this->validateDays();
        // $this->validate();
        // dd($this->opening, $this->closing, $this->openingOptional, $this->closingOptional);
    }

    private function validateDays()
    {
        // dd($this->schedules);

        $countDays = [
            'Lu' => 0,
            'Ma' => 0,
            'Mie' => 0,
            'Ju' => 0,
            'Vi' => 0,
            'Sa' => 0,
            'Do' => 0,
        ];

        foreach ($this->schedules as $key => $schedule) {
            foreach ($schedule['selectDays'] as $day) {
                ++$countDays[$day];
            }
        }

        dd($countDays);

        $message = 'Los días no pueden tener más de una jornada designada.';
        session()->flash('scheduleMessage', $message);
    }

    public function render()
    {
        return view('livewire.schedule.schedule-store-show-component');
    }
}
