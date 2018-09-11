<?php

return [
    'name.required' => 'Enter your name.',
    'name.max' => 'The name cannot exceed 255 characters.',
    'campaign_id.required' => 'Campaign name is required.',
    'campaign_id.exists' => 'This campaign does not exist.',
    'campaign_id.owner_of_campaign' => 'You are not the owner of the campaign.',
    'status.required' => 'Status is required.',
    'status.in' => 'Status can take one of two values: 0 (on), 1 (off), 2 (moderation), 3 (archive).',
    'daily_budget.numeric' => 'Value must be a digit.',
    'daily_budget.min' => 'Value must be greater than 0.',
    'budget.numeric' => 'Value must be a digit.',
    'budget.min' => 'Value must be greater than 0.',
    'daily_budget.campaign_daily_budget_limit' => 'Daily ad group limit cannot exceed that of the campaign.',
    'budget.campaign_budget_limit' => 'Ad group budget cannot exceed that of the campaign.',
    'click_price.required' => 'Price for a click is required.',
    'click_price.min' => 'Price for a click cannot be less than 0.',
    'click_price.max_click_price' => 'Price for a click cannot exceed the budget of a group in creation or editing.',
    'segments.present' => 'Enter segment parameter. It must be a minimum of an empty array [].',
    'segments.array' => 'Type of the entered parameter must be an array.',
    'segments.segments_exists' => 'Not all entered segments exist.'
];