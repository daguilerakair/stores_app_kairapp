<?php

namespace App\Livewire\subStore;

use App\Jobs\SendStoreToMobile;
use App\Livewire\SubStore\SubstoreShowComponent;
use App\Models\SubStore;
use Livewire\Component;

class SubStoreFormShowComponent extends Component
{
    // Tienda seleccionada
    public $selectedStore;

    public $name;
    public $address;
    public $commission;
    public $phone;
    public $latitude = 0.0;
    public $longitude = 0.0;

    public $disabledButton = false; // Controls button state

    public $schedules = [];

    public $viewOptionalSchedules = false;

    public $days = [
        'Lu' => 'Lunes',
        'Ma' => 'Martes',
        'Mie' => 'Miércoles',
        'Ju' => 'Jueves',
        'Vi' => 'Viernes',
        'Sa' => 'Sábado',
        'Do' => 'Domingo',
    ];

    public $listeners = ['updateSelectedSchedule'];

    public function addSubStore()
    {
        $response = $this->validateDays();

        // dd($response);
        if ($response) {
            // dd($this->schedules);
            $this->addScheduleToSubstore();
            // dd($this->selectedStore);
            // Validate information related to the substore
            $this->validate($this->rules());
            $this->disabledButton = true;

            // Create the substore
            $subStore = $this->createSubStore();

            // Send the substore to the mobile app
            SendStoreToMobile::dispatch($this->selectedStore, $subStore);

            $this->dispatch('render')->to(SubstoreShowComponent::class);
            toastr()->success('La sucursal fue creada con éxito', 'Sucursal creada!');
            $this->returnStoresManagement();
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'commission' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'opening' => 'required',
            'closing' => 'required',
        ];
    }

    private function createSubStore()
    {
        // Creates a new subStore record in the database with the provided details.
        $subStore = SubStore::create([
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'commission' => $this->commission,
            'phone' => $this->phone,
            'store_rut' => $this->selectedStore->rut,
        ]);

        return $subStore;
    }

    private function addScheduleToSubstore()
    {
        // dd($this->schedules);
        $scheduleDays = [];

        foreach ($this->schedules as $key => $schedule) {
            foreach ($schedule['selectDays'] as $key => $day) {
                if ($day) {
                    if ($schedule['viewOptionalSchedules']) {
                        $scheduleDays[] = [
                            'opening' => $schedule['opening'],
                            'openingOptional' => $schedule['openingOptional'],
                            'closing' => $schedule['closing'],
                            'closingOptional' => $schedule['closingOptional'],
                            'day' => $this->days[$key],
                            'substore_id' => 5,
                        ];
                    } else {
                        $scheduleDays[] = [
                            'opening' => $schedule['opening'],
                            'closing' => $schedule['closing'],
                            'day' => $this->days[$key],
                            'substore_id' => 5,
                        ];
                    }
                }
            }
        }
        dd($scheduleDays, $this->days['Lu']);
    }

    public function returnStoresManagement()
    {
        $this->redirect('/stores/management');
    }

    private function validateDays()
    {
        // $this->verifyEmptySchedules();

        $responses = $this->countDays();

        $checkRepeatDays = $responses[0];
        $emptySchedules = $responses[1];

        // dd($checkRepeatDays, $emptySchedules);

        if (!$checkRepeatDays && !$emptySchedules) {
            return true;
        } else {
            if ($emptySchedules) {
                $message = 'Un horario debe ser asignado al menos a un día.';
                session()->flash('scheduleMessage', $message);
            } else {
                $message = 'Los siguientes días no pueden tener más de una jornada designada:    '.$checkRepeatDays;
                session()->flash('scheduleMessage', $message);
            }

            return false;
        }
    }

    private function verifyEmptySchedules()
    {
        $emptySchedules = [];
    }

    private function countDays()
    {
        $countDays = [
            'Lu' => 0,
            'Ma' => 0,
            'Mie' => 0,
            'Ju' => 0,
            'Vi' => 0,
            'Sa' => 0,
            'Do' => 0,
        ];

        $emptySchedules = false;
        $badListDays = [];
        // Count the number of days that have been selected.
        foreach ($this->schedules as $key => $schedule) {
            if (count($schedule['selectDays']) === 0) {
                $emptySchedules = true;
                break;
            }
            foreach ($schedule['selectDays'] as $key => $day) {
                if ($day) {
                    if ($countDays[$key] > 0) {
                        $badListDays[$key] = $this->days[$key];
                    }
                    ++$countDays[$key];
                }
            }
        }

        $stringListDays = implode(', ', $badListDays);

        return [$stringListDays, $emptySchedules];
    }

    public function viewHiddenInformation($key)
    {
        $this->schedules[$key]['viewOptionalSchedules'] = !$this->schedules[$key]['viewOptionalSchedules'];
    }

    public function addShieldSchedule()
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

    public function removeShieldSchedule($key)
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

    public function mount($selectedStore)
    {
        $this->selectedStore = $selectedStore;

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

    public function render()
    {
        return view('livewire.subStore.sub-store-form-show-component');
    }
}
