<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentalResource\Pages;
use App\Filament\Resources\RentalResource\RelationManagers;
use App\Models\Rental;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RentalResource extends Resource
{
    protected static ?string $model = Rental::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Penyewa')
                    ->required(),

                Select::make('motor_id')
                    ->label('Motor')
                    ->relationship('motor', 'model')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $motor = Motor::find($state);
                        if ($motor) {
                            $set('total_price', $motor->harga_sewa);
                        }
                    }),



                DatePicker::make('start_date')->label('Tanggal Mulai')->required(),
                DatePicker::make('end_date')->label('Tanggal Selesai')->required(),

                TextInput::make('total_price')->label('Total Harga')->numeric()->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'confirmed' => 'Dibayar',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required(),
            ]);
    }
    

     public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Pelanggan'),
                TextColumn::make('motor.brand')->label('Merk'),
                TextColumn::make('motor.model')
                    ->label('Model'),
                TextColumn::make('motor.plate_number')
                    ->label('PLat'),
                TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->date(),
                TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->date(),
                TextColumn::make('lama_sewa')
                    ->label('Durasi')
                    ->getStateUsing(function ($record) {
                        $start = \Carbon\Carbon::parse($record->start_date);
                        $end = \Carbon\Carbon::parse($record->end_date);
                        return $start->diffInDays($end) + 1 . ' hari';
                    }),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR'),
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
    // public static function canCreate(): bool
    // {
    //     return false;
    // }
}

