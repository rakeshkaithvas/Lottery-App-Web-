<div class="card-body">
    <nav aria-label="Page navigation" class="pagination-style-1">
        @if (empty($users))
            {{ $data->links() }}
        @else
            {{ $users->links() }}
        @endif
    </nav>
</div>
