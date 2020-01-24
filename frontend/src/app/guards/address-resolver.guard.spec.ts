import { TestBed, async, inject } from '@angular/core/testing';

import { AddressResolverGuard } from './address-resolver.guard';

describe('AddressResolverGuard', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [AddressResolverGuard]
    });
  });

  it('should ...', inject([AddressResolverGuard], (guard: AddressResolverGuard) => {
    expect(guard).toBeTruthy();
  }));
});
