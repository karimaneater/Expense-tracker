<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {

        return $form
           ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                                ->required()
                                ->maxlength(255),
                    TextInput::make('email')
                                ->email()
                                ->maxlength(255)
                                ->required(),
                    Select::make('roles')
                                ->multiple()
                                ->maxItems(1)
                                ->relationship('roles','name')
                                ->required(),
                    TextInput::make('password')
                                ->password()
                                ->required()
                                ->confirmed()
                                ->minLength(8)
                                ->disableAutocomplete()
                                ->same('password_confirmation')
                                ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                    TextInput::make('password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->disableAutocomplete()
                                ->required()
                                ->minLength(8),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
