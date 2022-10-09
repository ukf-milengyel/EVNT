<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skupiny') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    --- tu bude správa skupín ---
                    <br><br>
                    stránka bude obsahovať:
                    <ul>
                        <li>Tabuľku skupín, stĺpce sú id, meno, farba, poč. členov, povolenia (samostatné stĺpce)</li>
                        <li>Pri každom zázname tlačidlo na úpravu, presmeruje na stránku kde sa dá skupina upraviť</li>
                        <li>Pri každom zázname tlačidlo vymazať, ak je poč. členov 0</li>
                        <li>Tlačidlo na pridanie novej skupiny</li>
                    </ul>

                    <br>
                    <a class="underline" href="{{ route('/group/add') }}">Pridať skupinu</a>

                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b">
                                <th>Meno</th>
                                <th>Povolenia</th>
                                <th>Farba</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                            <tr class="border-b">
                                <td>{{$group->name}}</td>
                                <td>{{$group->permissions}}</td>
                                <td>{{$group->color}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
