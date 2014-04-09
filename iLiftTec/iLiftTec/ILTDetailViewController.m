//
//  ILTDetailViewController.m
//  iLiftTec
//
//  Created by Ivan Diaz on 3/23/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTDetailViewController.h"

@interface ILTDetailViewController ()
- (void)configureView;
@end

@implementation ILTDetailViewController

#pragma mark - Managing the detail item

- (void)setDetailItem:(id)newDetailItem
{
    if (_detailItem != newDetailItem) {
        _detailItem = newDetailItem;
        
        // Update the view.
        [self configureView];
    }
}

- (void)configureView
{
    // Update the user interface for the detail item.

    if (self.detailItem) {
        self.detailDescriptionLabel.text = [self.detailItem description];
    }
    
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
    [self configureView];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
