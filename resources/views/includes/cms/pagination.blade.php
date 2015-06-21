<div class="text-center text-muted" role="status" aria-live="polite">Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} of {{$paginator->total()}} entries</div>
<div style="display:flex;justify-content:center;align-items:center;" >
	<p></p>
	{!! with(new Illuminate\Pagination\BootstrapThreePresenter($paginator))->render()!!}
</div>
