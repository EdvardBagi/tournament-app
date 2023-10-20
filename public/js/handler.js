$(document).ready(function () {
    $.ajaxSetup({
        headers:
            {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });
    $('#submitTournament').on('click', function (e) {
        e.preventDefault();
        let name = $('#nameT').val();
        let year = $('#year').val();
        if(name.length === 0 || year.length === 0) {
            alert('All fields are required.');
        } else {
            $.ajax({
                type: 'POST',
                url: $('meta[name="TS"]').attr('content'),
                data: {'nameT': name, 'year': year},
                success: function () {
                    $('#tournamentForm')[0].reset();
                    $('#tournamentTable').load(document.URL + ' #tournamentTable');
                    $('#roundForm').load(document.URL + ' #roundForm');
                },
                error: function () {
                    alert('Tournament already exists.');
                }
            });
        }


    });
    $(document).on('click', '#submitUser', function (e) {
        e.preventDefault();
        let name = $('#userName').val();
        let email = $('#userEmail').val();
        let password = $('#userPassword').val();
        if(name.length === 0 || email.length === 0 || password.length === 0) {
            alert('All fields are required.');
        } else {
            $.ajax({
                type: 'POST',
                url: $('meta[name="US"]').attr('content'),
                data: {'name': name,'email': email, 'password':password},
                success: function () {
                    $('#userForm')[0].reset();
                    $('#userTable').load(document.URL + ' #userTable');
                    $('#contestantForm').load(document.URL + ' #contestantForm');
                },
                error: function () {
                    alert('User already exists.');
                }
            });
        }


    });
});
$(document).on('click', '#submitRound', function (e) {
    e.preventDefault();
    let name = $('#nameR').val();
    let both = $('#both option:selected').text();
    let arr = both.split(",");
    let name2 = arr[0];
    let year = arr[1];
    if(name2 === undefined || year === undefined || name.length === 0 || name2.length === 0 || year.length ===0) {
        alert('All fields are required.');
    } else {
        $.ajax({
            type: 'POST',
            url: $('meta[name="RS"]').attr('content'),
            data: {'nameR': name, 'nameTournament': name2, 'year': year},
            success: function () {
                $('#roundForm').load(document.URL + ' #roundForm');
                $('#roundTable').load(document.URL + ' #roundTable');
                $('#contestantForm').load(document.URL + ' #contestantForm');
            },
            error: function () {
                alert('Round already exists.');
            }
        });
    }
});
$(document).on('click', '#submitContestant', function (e) {
    e.preventDefault();
    let name = $('#user option:selected').text();
    let round = $('#round option:selected').text();
    let list = name.split(",");
    let arr = round.split(",");
    let id = list[0];
    let userName = list[1];
    let roundName = arr[0];
    let tournament = arr[1];
    let year = arr[2];

    if(id === undefined || roundName === undefined || tournament === undefined || year === undefined ||userName === undefined || userName.length ===0) {
        alert('All fields are required.');
    } else {
        $.ajax({
            type: 'POST',
            url: $('meta[name="CS"]').attr('content'),
            data: {'id': id,'round': roundName,'tournament_name':tournament,'tournament_year':year},
            success: function () {
                $('#contestantForm').load(document.URL + ' #contestantForm');
                $('#contestantTable').load(document.URL + ' #contestantTable');
            },
            error: function () {
                alert('Contestant already exists.');
            }
        });
    }
});



//DELETES
$(document).on('click', '.deleteTournament', function (e) {
    e.preventDefault();
    let row = $(this).closest('tr');
    let nameT = row.find('td:nth-child(1)').text();
    let yearT = row.find('td:nth-child(2)').text();
    console.log(nameT, yearT);
    $.ajax({
        type: 'POST',
        url: $('meta[name="TD"]').attr('content'),
        data: {'name': nameT, 'year': yearT},
        success: function () {
            $('#tournamentTable').load(document.URL + ' #tournamentTable');
            $('#roundForm').load(document.URL + ' #roundForm');
            $('#roundTable').load(document.URL + ' #roundTable');
            $('#contestantTable').load(document.URL + ' #contestantTable');
            $('#contestantForm').load(document.URL + ' #contestantForm');
        }
    });
});
$(document).on('click', '.deleteRound', function (e) {
    e.preventDefault();
    let row = $(this).closest('tr');
    let round = row.find('td:nth-child(1)').text();
    let TName = row.find('td:nth-child(2)').text();
    let TYear = row.find('td:nth-child(3)').text();
    $.ajax({
        type: 'POST',
        url: $('meta[name="RD"]').attr('content'),
        data: {'round': round, 'TName': TName, 'TYear': TYear},
        success: function () {
            $('#roundTable').load(document.URL + ' #roundTable');
            $('#contestantTable').load(document.URL + ' #contestantTable');
            $('#contestantForm').load(document.URL + ' #contestantForm');
        }
    });
});
$(document).on('click', '.deleteContestant', function (e) {
    e.preventDefault();
    let row = $(this).closest('tr');
    let id = row.find('td:nth-child(1)').text();
    let round = row.find('td:nth-child(3)').text();
    let tournament_name = row.find('td:nth-child(4)').text();
    let tournament_year = row.find('td:nth-child(5)').text();
    $.ajax({
        type: 'POST',
        url: $('meta[name="CD"]').attr('content'),
        data: {'id': id, 'round': round,'tournament_name':tournament_name,'tournament_year':tournament_year},
        success: function () {
            $('#contestantTable').load(document.URL + ' #contestantTable');
        }
    });
});
$(document).on('click', '.deleteUser', function (e) {
    e.preventDefault();
    let row = $(this).closest('tr');
    let name = row.find('td:nth-child(1)').text();
    let email = row.find('td:nth-child(2)').text();
    $.ajax({
        type: 'POST',
        url: $('meta[name="UD"]').attr('content'),
        data: {'username': name, 'email': email},
        success: function () {
            $('#userTable').load(document.URL + ' #userTable');
            $('#contestantTable').load(document.URL + ' #contestantTable');
            $('#contestantForm').load(document.URL + ' #contestantForm');
        }
    });
});
