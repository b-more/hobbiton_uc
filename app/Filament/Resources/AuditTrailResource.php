<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditTrailResource\Pages;
use App\Filament\Resources\AuditTrailResource\RelationManagers;
use App\Models\AuditTrail;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AuditTrailResource extends Resource
{
    protected static ?string $model = AuditTrail::class;

    public static function getEloquentQuery(): Builder
    {
        // Check if there's an authenticated user
        $user = Auth::user();

        $query = parent::getEloquentQuery();

        if ($user->is_client == 1) {
            // Customize the query as needed
            return $query->where('business_id', $user->business_id)->orderBy('created_at', 'desc');
        }elseif($user->is_client == 0)
        {
            return $query->orderBy('created_at', 'desc');
        }

        // If it's not regulator_id 1 or no authenticated user, return an empty query
        return static::getModel()::query()->where("service_provider_id", 0);

    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Audit Trail';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('business.name')->label('User')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('module')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('activity')->wrap()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('ip_address')->label('IP Address')->wrap()->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAuditTrails::route('/'),
            'create' => Pages\CreateAuditTrail::route('/create'),
            'edit' => Pages\EditAuditTrail::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadAuditTrailPermission();
    }
}
