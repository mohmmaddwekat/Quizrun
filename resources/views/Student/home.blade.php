<section class="popular pt-5 pb-5 text-center">
    <div class="mb-4">
        <p class="text-uppercase text-dark-50 fs-4">{{ __('suggested for you') }}</p>
    </div>
    <div class="">

    </div>
    <div class="container">
        <div class="row d-flex justify-content-center content">
            @foreach ($groups as $group)
                @php
                    $group_user = $group
                        ->users()
                        ->pluck('id')
                        ->toArray();
                @endphp
                <div class="col-sm-6 col-md-4 grid-item grid-sizer col-lg-3 mb-3 me-sm-5">
                    <div class="box position-relative mb-3 overflow-hidden">
                        <a href="{{ route('student.group.index', $group->id) }}" class="ti-slow-motion play-btn">
                            <div class="images position-relative" data-name="{{ $group->name }}">
                                @php
                                    $path = $group->image == null ? '/assets/img/image-placeholder.PNG' : '/assets/uploads/' . $group->image;
                                @endphp
                                <img src="{{ $path }}" class="img-fluid" alt="{{ $group->name }}">
                            </div>
                        </a>
                        
                        @if (!empty($group->users))
                            @if (!in_array(auth('student')->id(), $group_user))
                                <button class="btn btn-block btn-outline-primary join-{{ $group->id }}"
                                    onclick="joinGroup({{ $group->id }})">{{__('Join')}}</button>
                            @endif
                        @endif
                        <span class="category text-wrap">{{ $group->category->name }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="pt-5 pb-5 text-center">
    <div class="mb-4">
        <p class="text-uppercase text-dark-50 fs-4">{{ __('Group Types') }}</p>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="{{ route('student.group.category', $category->id) }}"
                                class="btn btn-primary">{{ __('View') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<script>
    function joinGroup(id) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "group/join/" + id,
            type: "POST",
            groupType: "json",
            success: function(result) {
                console.log(result);
                if (result) {
                    $('.join').css("display", "none")
                    Toast.fire({
                        icon: "{{ __('Success') }}",
                        title: "{{ __('The request to join has been successfully sent.') }}",
                    })
                } else {
                    Toast.fire({
                        icon: "{{ __('Error') }}",
                        title: "{{ __('The request was not sent, a problem occurred.') }}"
                    })
                }
            },
        });
    }
</script>
