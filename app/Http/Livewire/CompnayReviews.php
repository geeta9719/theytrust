<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CompanyReview;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Helpers\SubscriptionHelper;


class CompnayReviews extends Component
{
    use WithPagination;

    public $companyId;
    public $service = '';
    public $sort    = 'recent';

    // keep filters & page in URL (back/forward works)
    protected $queryString = ['service', 'sort', 'page'];

    // don’t write defaults in URL
    protected $updatesQueryString = [
        'service' => ['except' => ''],
        'sort'    => ['except' => 'recent'],
    ];

    protected function serviceOptions()
{
    return CompanyReview::where('company_id', $this->companyId)
        ->pluck('how_effective')
        ->flatMap(function ($csv) {
            return collect(explode(',', (string)$csv))
                ->map(fn($s) => trim($s))
                ->filter();
        })
        ->unique()
        ->sort()
        ->values();
}

    public function updatingService() { $this->resetPage(); }
    public function updatingSort()    { $this->resetPage(); }

    protected function allowedPerPage(): int
    {
        $reviewLimit = SubscriptionHelper::getReviewLimit($this->companyId);
        $maxLimit    = 3;                    // your cap
        // if plan > cap → show cap; else show up to plan limit (min 1)
        return $reviewLimit > $maxLimit ? $maxLimit : max(1, $reviewLimit);
    }

    public function getCompanyProperty()
    {
        return Company::findOrFail($this->companyId);
    }

    public function getReviewsProperty()
{
    $pageSize = $this->allowedPerPage();

    return CompanyReview::with('user')
        ->where('company_id', $this->companyId)
        ->when($this->service, fn($q) =>
            $q->whereRaw('FIND_IN_SET(?, how_effective)', [$this->service])
        )
        ->when($this->sort === 'highest', fn($q) => $q->orderByDesc('overall_rating'))
        ->when($this->sort === 'lowest',  fn($q) => $q->orderBy('overall_rating'))
        ->when($this->sort === 'recent',  fn($q) => $q->orderByDesc('id'))
        ->paginate($pageSize);
}

    public function render()
    {
        // rating box (kept here so Blade stays simple)
        $rateReview = DB::table('company_reviews')
            ->select('company_id', 'position_title', 'most_impressive', 'project_title')
            ->selectRaw('count(id) as review')
            ->selectRaw('avg(overall_rating) as rating')
            ->where('company_id', $this->companyId)
            ->orderByDesc('id')
            ->first();

        // services for filter (change if your relation differs)
        $services = $this->company->services ?? collect();

        return view('livewire.compnay-reviews', [
            'reviews'     => $this->reviews,
            'rate_review' => $rateReview,
            'services'    => $services,
            'company'     => $this->company,
            'serviceOptions' => $this->serviceOptions(),
        ]);
    }
}
