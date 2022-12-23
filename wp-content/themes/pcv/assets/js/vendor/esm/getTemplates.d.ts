/** @jsx createElement */
import { SourceTemplates } from '@algolia/autocomplete-js';
import { QuerySuggestionsHit } from './types';
export declare type GetTemplatesParams<TItem extends QuerySuggestionsHit> = {
    onTapAhead(item: TItem): void;
};
export declare function getTemplates<TItem extends QuerySuggestionsHit>({ onTapAhead, }: GetTemplatesParams<TItem>): SourceTemplates<TItem>;
