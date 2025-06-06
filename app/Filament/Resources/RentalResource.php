<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Motor;
use App\Models\Rental;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RentalResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RentalResource\RelationManagers;

class RentalResource extends Resource
{
    protected static ?string $model = Rental::class;
    protected static ?string $navigationLabel = 'Penyewaan';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Pelanggan'),
                TextColumn::make('motor.brand')->label('Merk'),
                TextColumn::make('motor.model')
                    ->label('Model'),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => fn($state) => $state === 'pending',
                        'success' => fn($state) => $state === 'confirmed',
                        'warning' => fn($state) => $state === 'completed',
                        'danger' => fn($state) => $state === 'cancelled',
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dibayar',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => ucfirst($state),
                    })
            ])
            ->filters([])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRentals::route('/'),
            // 'create' => Pages\CreateRental::route('/create'),
            'edit' => Pages\EditRental::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }
}
