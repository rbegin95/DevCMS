@extends('housekeeping.app')

@section('title', 'Manage Permissions')

@section('content')
<div class="container">
    <h1>Manage Permissions</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Form -->
    <div class="mb-4">
        <input type="text" id="searchRank" class="form-control" placeholder="Enter Rank ID or Name to Search">
    </div>

    <!-- Permissions Display -->
    <div id="rankPermissionsContainer" style="display: none;">
        <h3 class="mt-4" id="rankName"></h3>

        <!-- Loop through each group of permissions -->
        <div id="permissionsGroups"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ranks = @json($ranks);
        const permissionGroups = @json($permissionGroups);
        
        document.getElementById('searchRank').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase().trim();
            const rank = ranks.find(r => r.rank_name.toLowerCase() === searchValue || r.id.toString() === searchValue);

            const rankPermissionsContainer = document.getElementById('rankPermissionsContainer');
            const permissionsGroups = document.getElementById('permissionsGroups');

            if (rank) {
                // Display the rank name
                document.getElementById('rankName').innerText = rank.rank_name;
                rankPermissionsContainer.style.display = 'block';
                permissionsGroups.innerHTML = '';

                // Generate the permission groups dynamically
                Object.entries(permissionGroups).forEach(([groupName, permissions]) => {
                    let card = document.createElement('div');
                    card.className = 'card mb-3';

                    let cardHeader = document.createElement('div');
                    cardHeader.className = 'card-header';
                    cardHeader.innerText = groupName;

                    let cardBody = document.createElement('div');
                    cardBody.className = 'card-body';

                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('housekeeping/permissions/') }}/${rank.id}`;
                    form.innerHTML = '@csrf @method('PUT')';

                    let row = document.createElement('div');
                    row.className = 'row';

                    permissions.forEach(permission => {
                        let col = document.createElement('div');
                        col.className = 'col-md-4 mb-2';

                        let formCheck = document.createElement('div');
                        formCheck.className = 'form-check';

                        let input = document.createElement('input');
                        input.type = 'checkbox';
                        input.className = 'form-check-input';
                        input.id = permission;
                        input.name = permission;
                        input.value = 1;
                        input.checked = rank[permission] == 1;

                        let label = document.createElement('label');
                        label.className = 'form-check-label';
                        label.setAttribute('for', permission);
                        label.innerText = permission.replace(/_/g, ' ');

                        formCheck.appendChild(input);
                        formCheck.appendChild(label);
                        col.appendChild(formCheck);
                        row.appendChild(col);
                    });

                    form.appendChild(row);
                    let submitButton = document.createElement('button');
                    submitButton.type = 'submit';
                    submitButton.className = 'btn btn-primary mt-3';
                    submitButton.innerText = 'Update Permissions';
                    form.appendChild(submitButton);

                    cardBody.appendChild(form);
                    card.appendChild(cardHeader);
                    card.appendChild(cardBody);
                    permissionsGroups.appendChild(card);
                });
            } else {
                rankPermissionsContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection
