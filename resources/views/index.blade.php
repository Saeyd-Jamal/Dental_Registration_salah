<x-front-layout>
    <div class="row">
        <!-- Bordered table -->
        <div class="col-12 my-4">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row justify-content-end ml-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRec">
                            حجز جديد
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:table :records="$records" :doctors="$doctors" />
                </div>
            </div>
        </div> <!-- Bordered table -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createRec" tabindex="-1" role="dialog" aria-labelledby="createRecLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="createRecLabel">حجز جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <livewire:modal />
            </div>
        </div>
    </div>

</x-front-layout>
