<?php

namespace App\Livewire\Admin\Charger;

use App\Models\Charge;
use App\Models\DeniedReason;
use App\Models\ShamCashAccount;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class ViewRequest extends Component
{
    use WithPagination;
    #[On('echo:charges,.charge.updated')]
    public function handleOrderUpdatedEvent($payload)
    {
        return 0; //refresh
    }
    #[On('echo:charges,.charge.created')]
    public function handleOrderCreatedEvent($payload)
    {
        return 0; //refresh
    }
    protected $listeners = ["refreshRequests"];
    public $admin;
    public $denied_reasons;
    public $shamcash;
    public function mount()
    {
        $this->denied_reasons = DeniedReason::get();
        $this->shamcash = ShamCashAccount::first();
    }
    //جلب المنتجات من تاريخ الانشاءالى الوقت الحاضر
    public $CreatedAt = "2000/1/1 00:00:00";
    public function updatedCreatedAt()
    {
        $this->reset("UpdatedAt");
        $this->resetPage();
    }

    //جلب المنتجات حسب التعديلات من تاريخ التعديل الى الوقت الحاضر
    public $UpdatedAt = "2000/1/1 00:00:00";
    public function updatedUpdatedAt()
    {
        $this->reset("CreatedAt");
        $this->resetPage();
    }

    public $ChargeStatus = "waiting";
    public function updatedChargeStatus()
    {
        $this->resetPage();
    }
    public $DeniedReason = "";
    public function updatedDeniedReason()
    {
        $this->resetPage();
    }
    public $TranscationNumber = "";
    public function search()
    {
        $this->reset("CreatedAt", "UpdatedAt", "ChargeStatus", "DeniedReason");
        $this->dispatch("clear-checkboxes");
        $this->resetPage();
    }
    //جلب  مع كل تحديث للفلتر
    #[Computed()]
    public function requests()
    {
        if ($this->DeniedReason) {
            if ($this->ChargeStatus == "waiting" || $this->ChargeStatus == "") {
                $charge = Charge::with(["img", "deniedReason"])->where("charge_status", "like", "%" . $this->ChargeStatus . "%")
                    ->whereHas("deniedReason", function ($query) {
                        $query->where("name", "like", "%" . $this->DeniedReason . "%");
                    })
                    ->where("transcation_number", "like", "%" . $this->TranscationNumber . "%")
                    ->where("created_at", ">=", Carbon::parse($this->CreatedAt))
                    ->where("updated_at", ">=", Carbon::parse($this->UpdatedAt))
                    ->orderBy("created_at", "desc")
                    ->orderBy("updated_at", "desc")->simplePaginate(20);
            } else {
                $charge = Charge::with(["img", "deniedReason"])->where("charge_status", "like", "%" . $this->ChargeStatus . "%")
                    ->where("admin_id", $this->admin->id)
                    ->whereHas("deniedReason", function ($query) {
                        $query->where("name", "like", "%" . $this->DeniedReason . "%");
                    })
                    ->where("transcation_number", "like", "%" . $this->TranscationNumber . "%")
                    ->where("created_at", ">=", Carbon::parse($this->CreatedAt))
                    ->where("updated_at", ">=", Carbon::parse($this->UpdatedAt))
                    ->orderBy("created_at", "desc")
                    ->orderBy("updated_at", "desc")->simplePaginate(20);
            }
        } else {
            if ($this->ChargeStatus == "waiting" || $this->ChargeStatus == "") {
                $charge = Charge::with(["img", "deniedReason"])->where("charge_status", "like", "%" . $this->ChargeStatus . "%")
                    ->where("transcation_number", "like", "%" . $this->TranscationNumber . "%")
                    ->where("created_at", ">=", Carbon::parse($this->CreatedAt))
                    ->where("updated_at", ">=", Carbon::parse($this->UpdatedAt))
                    ->orderBy("created_at", "desc")
                    ->orderBy("updated_at", "desc")->simplePaginate(20);
            } else {
                $charge = Charge::with(["img", "deniedReason"])->where("charge_status", "like", "%" . $this->ChargeStatus . "%")
                    ->where("admin_id", $this->admin->id)
                    ->where("transcation_number", "like", "%" . $this->TranscationNumber . "%")
                    ->where("created_at", ">=", Carbon::parse($this->CreatedAt))
                    ->where("updated_at", ">=", Carbon::parse($this->UpdatedAt))
                    ->orderBy("created_at", "desc")
                    ->orderBy("updated_at", "desc")->simplePaginate(20);
            }
        }
        return $charge;
    }
    public function resetFilters()
    {
        $this->reset("CreatedAt", "UpdatedAt", "ChargeStatus", "DeniedReason", "TranscationNumber");
        $this->dispatch("clear-checkboxes");
    }
    public function refreshRequests()
    {
        return 0;
    }
    public function render()
    {
        return view('livewire.admin.charger.view-request', ["requests" => $this->requests]);
    }
}
