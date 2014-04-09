//
//  ILTMusculoTableViewCell.h
//  iLiftTec
//
//  Created by Ivan Diaz on 3/27/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ILTMusculoTableViewCell : UITableViewCell
@property (strong, nonatomic) IBOutlet UILabel *musculoLabel;
@property (nonatomic, assign) BOOL buttonIsOn;
- (IBAction)checkButton:(id)sender;

@end
