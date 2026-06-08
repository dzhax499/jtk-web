<?php

namespace App\Helpers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class DynamicFieldsHelper
{
    /**
     * Get dynamic form components for a given target resource class.
     */
    public static function getFormComponents(string $modelClass): array
    {
        $dynamicComponents = [];

        try {
            if (\Schema::hasTable('dynamic_field_configs')) {
                $configs = \App\Models\DynamicFieldConfig::where('target_resource', $modelClass)
                    ->orWhere('target_resource', class_basename($modelClass))
                    ->get();

                foreach ($configs as $config) {
                    $component = match ($config->type) {
                        'text' => TextInput::make("extra_attributes.{$config->name}"),
                        'textarea' => Textarea::make("extra_attributes.{$config->name}"),
                        'toggle' => Toggle::make("extra_attributes.{$config->name}"),
                        'select' => Select::make("extra_attributes.{$config->name}")
                            ->options($config->options ?? [])
                            ->native(false),
                        'number' => TextInput::make("extra_attributes.{$config->name}")->numeric(),
                        default => null,
                    };

                    if ($component) {
                        $component->label($config->label);
                        if ($config->is_required) {
                            $component->required();
                        }
                        if ($config->placeholder) {
                            $component->placeholder($config->placeholder);
                        }
                        $dynamicComponents[] = $component;
                    }
                }
            }
        } catch (\Throwable $e) {
            // Fail silently
        }

        if (!empty($dynamicComponents)) {
            return [
                Section::make('Informasi Tambahan')
                    ->description('Field tambahan dinamis yang dikonfigurasi oleh admin.')
                    ->schema($dynamicComponents)
                    ->collapsible()
            ];
        }

        return [];
    }

    /**
     * Get dynamic table columns for a given target resource class.
     */
    public static function getTableColumns(string $modelClass): array
    {
        $dynamicColumns = [];

        try {
            if (\Schema::hasTable('dynamic_field_configs')) {
                $configs = \App\Models\DynamicFieldConfig::where('target_resource', $modelClass)
                    ->orWhere('target_resource', class_basename($modelClass))
                    ->get();

                foreach ($configs as $config) {
                    if ($config->type === 'toggle') {
                        $column = IconColumn::make("extra_attributes.{$config->name}")
                            ->label($config->label)
                            ->boolean()
                            ->toggleable(isToggledHiddenByDefault: true);
                    } else {
                        $column = TextColumn::make("extra_attributes.{$config->name}")
                            ->label($config->label)
                            ->searchable()
                            ->toggleable(isToggledHiddenByDefault: true);

                        if ($config->type === 'select' && !empty($config->options)) {
                            $options = $config->options;
                            $column->formatStateUsing(fn ($state) => $options[$state] ?? $state);
                        }
                    }

                    $dynamicColumns[] = $column;
                }
            }
        } catch (\Throwable $e) {
            // Fail silently
        }

        return $dynamicColumns;
    }
}
